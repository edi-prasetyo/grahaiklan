<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Category;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Models\Advertisement;
use App\Models\City;
use App\Models\Image;
use App\Models\Province;
use App\Models\Subcategory;
use App\Models\VerifyOtp;
use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {

        $sliders = Slider::where('status', '1')->get();
        $categories = Category::where('status', 1)->with('advertisements')->get();
        $provinces = Province::all();
        $ads = Advertisement::select('advertisements.id',  'advertisements.title', 'advertisements.price', 'advertisements.slug', 'advertisements.name', 'advertisements.views', 'advertisements.phone', 'advertisements.description', 'advertisements.status', 'advertisements.updated_at', 'categories.name as category_name', 'categories.slug as category_slug', 'provinces.name as province_name', 'cities.name as city_name')
            ->leftJoin('categories', 'categories.id', '=', 'advertisements.category_id')
            ->leftJoin('provinces', 'provinces.id', '=', 'advertisements.province_id')
            ->leftJoin('cities', 'cities.id', '=', 'advertisements.city_id')
            ->where('advertisements.status', 1)
            ->with('images')
            ->orderBy('views', 'desc')->take(4)->get();

        // $images = $ads->adsImages;



        return view('frontend.index', compact('sliders', 'categories', 'provinces', 'ads'));
    }
    public function categories()
    {
        $categories = Category::where('status', 1)->get();
        return view('frontend.category.index', compact('categories'));
    }

    public function verify_otp()
    {
        return view('auth.verify_otp');
    }
    public function send_otp(Request $request)
    {
        $input_otp = $request->otp;
        $get_otp = VerifyOtp::where('otp', $input_otp)->first();

        if ($get_otp) {

            // $get_otp->status == 1;
            // $get_otp->save();

            $user = User::where('email', $get_otp->email)->first();
            $user->status = 1;
            $user->save();

            VerifyOtp::where('email', $get_otp->email)->delete();
            // $getting_otp->delete();

            return redirect('home')->with('activated', 'Akun anda sudah di aktivasi');
        } else {
            return redirect('verify/otp')->with('incorrect', 'OTP tidak valid');
        }
    }

    public function resend_otp(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::where('id', $user_id)->first();

        $delete_otp = VerifyOtp::where('email', $user->email)->delete();
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

            return redirect('verify/otp')->with('sending', "Kode OTP telah dikirim ke Nomor $user->phone");
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

            return redirect('verify/otp')->with('sending', "Kode OTP telah dikirim ke Nomor $user->phone");
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

    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("province_id", $request->province_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }
    public function fetchSubcategory(Request $request)
    {
        $data['subcategory'] = Subcategory::where(["category_id" => $request->category_id, 'premium' => 0])
            ->get(["name", "id"]);

        return response()->json($data);
    }
}
