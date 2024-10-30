<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\VerifyOtp;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $uuid = Str::uuid()->toString();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|unique:users'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ]);
        }

        $user = User::create([
            'uuid' => $uuid,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => request('phone'),
            'role_as' => 4,
            'status' => 0,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        if ($user) {
            $validOtp = rand(10, 100. . '2022');

            $get_otp = new VerifyOtp();
            $get_otp->otp = $validOtp;
            $get_otp->email = $user['email'];
            $get_otp->phone = $user['phone'];

            $get_otp->save();
            $get_user_email = $user['email'];
            $get_user_name = $user['name'];
            $get_user_phone = $user['phone'];
            Mail::to($user['email'])->send(new WelcomeMail($get_user_email, $validOtp, $get_user_name, $get_user_phone));

            $this->send_whatsapp($validOtp, $get_user_phone);

            return response()->json([
                'success' => true,
                'data' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'message' => 'Successfully Register'
            ]);
        } else {
            return response()->json(['message' => 'Failed Register! Try Again']);
        }
    }

    public function otp(Request $request)
    {
        $input_otp = $request->otp;
        $get_otp = VerifyOtp::where('otp', $input_otp)->first();

        if ($get_otp) {
            // $get_otp->status == 1;
            // $get_otp->save();

            $user = User::where('email', $get_otp->email)->first();
            $user->status = 1;
            $user->save();

            $user_detail = new UserDetail();
            $user_detail->uuid = $user->uuid;
            $user_detail->user_id = $user->id;
            $user_detail->save();

            $getting_otp = VerifyOtp::where('email', $get_otp->email)->first();
            $getting_otp->delete();

            return response()->json([
                'success' => true,
                'message' => 'Account Activation Succesfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'OTP Not Valid',
            ]);
        }
    }

    public function resend_otp(Request $request)
    {
        $phone = $request->phone;
        $user = User::where('phone', $phone)->first();

        $delete_otp = VerifyOtp::where('phone', $phone)->delete();
        if ($delete_otp == null) {

            $validOtp = rand(10, 100. . '2022');

            $get_otp = new VerifyOtp();
            $get_otp->otp = $validOtp;
            $get_otp->email = $user->email;
            $get_otp->phone = $user->phone;
            $get_otp->save();

            $get_user_email = $user->email;
            $get_user_name = $user->name;
            $get_user_phone = $user->phone;
            Mail::to($user->email)->send(new WelcomeMail($get_user_email, $validOtp, $get_user_name, $get_user_phone));

            $this->send_whatsapp($validOtp, $get_user_phone);
            return response()->json([
                'success' => true,
                'message' => 'Otp send to: ' . $user->phone
            ]);
        } else {


            $validOtp = rand(10, 100. . '2022');

            $get_otp = new VerifyOtp();
            $get_otp->otp = $validOtp;
            $get_otp->email = $user->email;
            $get_otp->phone = $user->phone;
            $get_otp->save();

            $get_user_email = $user->email;
            $get_user_name = $user->name;
            $get_user_phone = $user->phone;
            Mail::to($user->email)->send(new WelcomeMail($get_user_email, $validOtp, $get_user_name, $get_user_phone));

            $this->send_whatsapp($validOtp, $get_user_phone);

            return response()->json([
                'success' => true,
                'message' => 'Otp send to: ' . $user->phone
            ]);
        }
    }

    public function send_whatsapp($validOtp, $get_user_phone)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $get_user_phone,
                'message' => "Ini adalah Kode OTP Pendaftaran Anda *$validOtp* Pesan ini dikirim dari atransauto.com jangan bagikan kode otp ini kepada siapapun",
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: KyJbdr0LxUSM#WXgzszp' //change TOKEN to your actual token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ]);
        }

        if (!Auth::attempt($request->only('email', 'password') + ['status' => 1])) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    public function profile()
    {

        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json('Logout Successfully');
    }
}
