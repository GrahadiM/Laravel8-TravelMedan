<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Post;
use App\Models\Category;
use App\Models\TravelPackage;
use App\Mail\StoreContactMail;
use App\Http\Requests\StoreEmailRequest;

class PageController extends Controller
{
    public function home() : View
    {
        $categories = Category::with('travel_packages')->get();
        $posts = Post::get();

        return view('home', compact('categories','posts'));
    }

    public function detail(TravelPackage $travelPackage) : View
    {
        return view('detail', compact('travelPackage'));
    }

    public function order(TravelPackage $travelPackage, Request $request) : View
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-wbmWfkTrpDPtKkWkaEdEZHMm';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $travelPackage->price,
            ),
            'customer_details' => array(
                'first_name' => auth()->user()->name,
                'last_name' => '',
                'email' => auth()->user()->email,
                'phone' => '',
            ),
            'callbacks' => array(
                'finish' => 'http://127.0.0.1:8000/'
            ),
            'enabled_payments' => array(
                'credit_card',
                'gopay',
                'shopeepay',
                'permata_va',
                'bca_va',
                'bni_va',
                'bri_va',
                'echannel',
                'other_va',
                'danamon_online',
                'mandiri_clickpay',
                'cimb_clicks',
                'bca_klikbca',
                'bca_klikpay',
                'bri_epay',
                'xl_tunai',
                'indosat_dompetku',
                'kioson',
                'Indomaret',
                'alfamart',
                'akulaku'
            ),
        );
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        // dd($params);

        return view('order', ['snap_token'=>$snapToken], compact('travelPackage'));
    }

    public function package()
    {
        $travelPackages = TravelPackage::with('galleries')->get();

        return view('package', compact('travelPackages'));
    }

    public function posts()
    {
        $posts = Post::get();

        return view('posts', compact('posts'));
    }

    public function detailPost(Post $post){
        return view('posts-detail',compact('post'));
    }

    public function contact()
    {
        // return view('contact');
        return view('contact-whatsapp');
    }

    // Contact-Us via WhatsApp
    public function getWhatsapp(Request $request){
        $name = $request->name;
        $email = $request->email;
        $message = $request->message;

        $url = 'https://api.whatsapp.com/send?phone=+6281360503971&text=Nama%20:%20'.$name.'%0AEmail%20:%20'.$email.'%0APesan%20:%20'.$message;
        // dd($url);
        
        return redirect($url);
    }

    // Contact-Us via Email
    public function getEmail(StoreEmailRequest $request){
        $detail = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];

        Mail::to('grahadim178@gmail.com')->send(new StoreContactMail($detail));
        return back()->with('message', 'Terimakasih atas feedbacknya! kami akan membacanya sesegera mungkin');
    }
}