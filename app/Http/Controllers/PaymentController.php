<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
// use Paystack;
use Unicodeveloper\Paystack\Facades\Paystack;
class PaymentController extends Controller
{
    /**
     * Redirect the User to Paystack Payment Page
     * @return mixed
     */
    public function redirectToGateway()
    {
        try {
            return Paystack::getAuthorizationUrl()->redirectNow();
        } catch (\Exception $e) {
            return Redirect::back()->withMessage(['msg' => 'The Paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
        }
    }
    public function showCheckoutForm()
    {
        return  view('client.blank');
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        try {
            $paymentDetails = Paystack::getPaymentData();
            dd($paymentDetails);

            // Now you have the payment details,
            // you can store the authorization_code in your db to allow for recurrent subscriptions
            // you can then redirect or do whatever you want
        } catch (\Exception $e) {
            // Handle the exception, maybe log it
            return Redirect::back()->withMessage(['msg' => 'An error occurred while processing the payment.', 'type' => 'error']);
        }
    }
}
