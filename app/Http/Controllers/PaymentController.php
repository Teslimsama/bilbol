<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User; // Adjust the namespace based on your model location
use App\Models\Payment; // Adjust the namespace based on your model location
use App\Models\Rented; // Adjust the namespace based on your model location
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Unicodeveloper\Paystack\Facades\Paystack;
use Brian2694\Toastr\Facades\Toastr;

class PaymentController extends Controller
{
    /**
     * Redirect the User to Paystack Payment Page
     * @return mixed
     */
    public function redirectToGateway(Request $request)
    {
        try {

            $txRef = 'Bilbol' . rand(99999, 10000000) . '_PSK';
            $amount = $request->input('amount') * 100;
            $meta = [
                "customer" => [
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'phone' => $request->input('phone'),
                    'email' => $request->input('email'),

                    'address' => $request->input('address'),
                ],
                "paymentDetails" => [
                    'id' => $request->input('id'),
                    'qty' => $request->input('qty'),
                    'price' => $request->input('price'),
                ]
            ];
            $paymentDetails = [
                'amount' => $amount,  // Amount in kobo               
                'reference' => $txRef,
                'metadata' => $meta,
                'email' => $request->input('email'),
            ];
            return Paystack::getAuthorizationUrl($paymentDetails)->redirectNow();
        } catch (\Exception $e) {
            Toastr::error('Payment Failed: ' . $e->getMessage(), 'Error');
            return Redirect::back();
            // dd($e);
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
            $paymentDetailsArray = (array) $paymentDetails;
            $image = 'noimage';
            $role = 'Renter';
            $dt = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();

            $todayDatepay = Carbon::now();

            // Check if the guest_user_id cookie exists
            $guestUserId = Cookie::get('guest_user_id');

            // If it doesn't exist, generate a new identifier
            if (!$guestUserId) {
                $guestUserId = Str::uuid()->toString();
                // Set the 'guest_user_id' cookie with a one-year expiration
                Cookie::queue('guest_user_id', $guestUserId, 525600); // 525600 minutes = 1 year
            }

            // Find the user in the database based on cookie_id
            $user = User::where('cookie_id', $guestUserId)->first();

            // If the user doesn't exist, create a new user
            if (!$user) {
                $user = new User;
                $user->firstname = $paymentDetailsArray['data']['metadata']['customer']['first_name'];
                $user->lastname = $paymentDetailsArray['data']['metadata']['customer']['last_name'];
                $user->address = $paymentDetailsArray['data']['metadata']['customer']['address'];
                $user->phone_number = $paymentDetailsArray['data']['metadata']['customer']['phone'];
                $user->email = $paymentDetailsArray['data']['metadata']['customer']['email'];
                $user->role_name = $role;
                $user->image = $image;
                $user->join_date = $todayDate;
                $user->password = bcrypt('default_password');
                $user->cookie_id = $guestUserId; // Associate the user with the guest_user_id
                $user->save();
            }

            // Create or update the rented record
            $rented = Rented::firstOrNew(['user_id' => $user->id]);
            $rented->total = $paymentDetailsArray['data']['amount'];
            // Add other fields you want to store
            $rented->save();


            // // Example: Store the payment details in your database
            foreach ($paymentDetailsArray['data']['metadata']['paymentDetails']['id'] as $key => $itemId) {
                $payment = new Payment(); // Adjust the namespace based on your model location

                // Check if 'price' is set, if not, provide a default value or handle it accordingly
                $price = !empty($paymentDetailsArray['data']['metadata']['paymentDetails']['price'][$key])
                    ? $paymentDetailsArray['data']['metadata']['paymentDetails']['price'][$key]
                    : 0; // Change the default value accordingly

                $payment->qty = $paymentDetailsArray['data']['metadata']['paymentDetails']['qty'][$key];
                $payment->price = $price;
                $payment->tx_ref = $paymentDetailsArray['data']['reference'];
                $payment->tx_id = 0; // Modify this based on your needs
                $payment->dis = 1;
                $payment->rented_date = $todayDatepay; // Modify this accordingly
                $payment->return_date = $todayDatepay->addDay(1); // 24 hours later
                $payment->amount = $price * $payment->qty; // Calculate the total amount
                $payment->inventory_id = $itemId;
                // Assuming $rented is the instance of Rented model created earlier
                $payment->rented_id = $rented->id;
                $payment->save();
                $cart = session()->get('cart');
                foreach ($paymentDetailsArray['data']['metadata']['paymentDetails']['id'] as $itemId) {
                    if (isset($cart[$itemId])) {
                        unset($cart[$itemId]);
                        // Check if the cart is empty, and remove the 'cart' key if it is
                        if (empty($cart)) {
                            session()->forget('cart');
                        } else {
                            session()->put('cart', $cart);
                        }
                        session()->flash('success', 'Products successfully removed!');
                    }
                }
            }
            // if ($itemId) {
            //     $cart = session()->get('cart');

            //     foreach ($itemId as $itemIds) {
            //         if (isset($cart[$itemId])) {
            //             unset($cart[$itemId]);
            //             // Check if the cart is empty, and remove the 'cart' key if it is
            //             if (empty($cart)) {
            //                 session()->forget('cart');
            //             } else {
            //                 session()->put('cart', $cart);
            //             }
            //             session()->flash('success', 'Products successfully removed!');
            //         }
            //     }
            // }

            // dd($paymentDetails);
            Toastr::success('Rented Product Successfully ', 'Success');
            // Now you have the payment details,
            // you can store the authorization_code in your db to allow for recurrent subscriptions
            // you can then redirect or do whatever you want
            return Redirect::back();
        } catch (\Exception $e) {
            // Handle the exception, maybe log it
            Toastr::error('Rented Product Failed ', 'Error');
            return Redirect::back();
        }
    }
}
