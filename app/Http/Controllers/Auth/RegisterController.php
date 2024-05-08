<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Providers\RouteServiceProvider;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\VerifyOtp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'unique:users'],
            'password' => [
                'required',
                Password::min(8)
                // ->letters()
                // ->mixedCase()
                // ->numbers()
                // ->symbols()
            ],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */


    protected function create(array $data)
    {
        $code = Str::uuid()->toString();
        $uuid = Str::uuid()->toString();
        $user = User::create([
            'uuid' => $code,
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_as' => 4,
            'status' => 0
        ]);

        $validOtp = rand(10, 100. . '2022');

        $get_otp = new VerifyOtp();
        $get_otp->otp = $validOtp;
        $get_otp->email = $data['email'];
        $get_otp->phone = $data['phone'];

        $get_otp->save();
        $get_user_email = $data['email'];
        $get_user_name = $data['name'];
        $get_user_phone = $data['phone'];
        Mail::to($data['email'])->send(new WelcomeMail($get_user_email, $validOtp, $get_user_name, $get_user_phone));

        $this->send_whatsapp($validOtp, $get_user_phone);

        $user_detail = new UserDetail();
        $user_detail->uuid = $uuid;
        $user_detail->user_id = $user->id;
        $user_detail->save();

        return $user;
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

    // protected function create(array $data)
    // {
    //     $code = Str::uuid()->toString(50);
    //     $user = User::create([
    //         'uuid' => $code,
    //         'name' => $data['name'],
    //         'phone' => $data['phone'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //         'role_as' => 4,
    //     ]);
    //     return $user;
    // }
}
