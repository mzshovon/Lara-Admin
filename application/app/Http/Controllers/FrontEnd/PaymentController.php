<?php

namespace App\Http\Controllers\FrontEnd;

use App\Payment;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Paystack;
use Session;
use Cart;

class PaymentController extends Controller
{
    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        if (array_key_exists('data', $paymentDetails) && array_key_exists('status', $paymentDetails['data']) && ($paymentDetails['data']['status'] === 'success')) {
            echo "Transaction was successful";
            $id = Session::get('payment_id');
            $payment = Payment::find($id);
            $payment->status = 2;
            $payment->save();
            Cart::destroy();
            Session::forget('payment_id');
            Session::forget('shipping_cost');
            Session::forget('payment_id');
            return redirect('/')->with('message', 'Order is completed. Admin will contact with you.');
        }else{
            return redirect('/')->with('message', 'Something Error! Order is not completed. Admin will contact with you.');
        }

    }
}
