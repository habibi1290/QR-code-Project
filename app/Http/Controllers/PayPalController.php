<?php


namespace App\Http\Controllers;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use App\Mail\PaymentConfirmed;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class PayPalController extends Controller
{
    public function payment(Request $request)
    {
       session([
           'name'     => $request->name,
           'street'   => $request->street,
           'postcode' => $request->postcode,
           'city'     => $request->city,
           'email'    => $request->email,
           'anzahl'   => (int) $request->zahl,
        ]);


        $amount = session('anzahl') * 60;

        if ($amount <= 0) {
            return back()->withErrors('Ungültiger Betrag');
        }

        $paypalAmount = number_format($amount, 2, '.', '');
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.payment.success'),
                "cancel_url" => route('paypal.payment.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "EUR",
                        "value" => $paypalAmount
                    ],
                ]
            ],
            "shipping" => [
                "name" => [
                    "full_name" => session('name')
                ],
                "address" => [
                    "address_line_1" => session('street'),
                    "admin_area_2" => session('city'),
                    "postal_code" => session('postcode'),
                    "email" => session('email')
                ]
            ]
        ]);
        //dd($response);

        $url = collect($response['links'])->where('rel', 'approve')->first()['href'];
        return redirect()->away($url);
    }

    public function paypalPaymentSuccess(Request $request) {

        $token = $request->token;
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $order = $provider->capturePaymentOrder($token);

        if(isset($order['status']) && $order['status'] === 'COMPLETED') {



            $qrContent =
                "Name: " . session('name') . "\n" .
                "E-Mail: " . session('email') . "\n" .
                "Betrag: " . (session('anzahl') * 60) . ",00 EUR";

            $qrImage = QrCode::format('png')
                ->size(300)
                ->margin(2)
                ->generate($qrContent);

            $fileName = 'qr_' . $token . '.png';

            Storage::disk('local')->put($fileName, $qrImage);


            $customerEmail = session('email');
            $paymentDetails = [
                'name' => session('name'),
                'street' => session('street'),
                'postcode' => session('postcode'),
                'city' => session('city'),
                'anzahl' => session('anzahl') * 60,
            ];

            $qrPath = Storage::disk('local')->path($fileName);
            Mail::to($customerEmail)->send(new PaymentConfirmed($paymentDetails, $qrPath));
            Storage::disk('local')->delete($fileName);
            session()->forget([
                'name','street','postcode','city','email','anzahl'
            ]);
            return view("paymentSuccess");
        }else {
            return redirect()->route("paypal.payment.cancel");
        }
    }

    public function paypalPaymentCancel(Request $request) {
        return view("paymentCancel");
    }
}


