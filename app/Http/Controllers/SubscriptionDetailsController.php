<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionDetails;
use App\Http\Requests\StoreSubscriptionDetailsRequest;
use App\Http\Requests\StoreWhereSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionDetailsRequest;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class SubscriptionDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $SubscriptionDetails = SubscriptionDetails::paginate(30);
        return $this->response(code: 200, data: $SubscriptionDetails);
    }
    public $stripe;
    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET', 'sk_test_51Q7zvlAKd03pxsFrF39kPa8qKdtfqRTZgVgdqsDKsZBkX8ue2YBTN951t8DOeoWhOd0658fI1S3v7BXqSrYTT0RN00RZnk4hEG'));
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET', 'sk_test_51Q7zvlAKd03pxsFrF39kPa8qKdtfqRTZgVgdqsDKsZBkX8ue2YBTN951t8DOeoWhOd0658fI1S3v7BXqSrYTT0RN00RZnk4hEG'));
    }
    public function pay(StoreWhereSubscriptionRequest $request)
    {
        $request = $request->validated();
        $Subscription = Subscription::all()->where('id', $request['id'])->first();
        $user = Auth::user();
        $User = $this->stripe->customers->create([
            'name' => $user['username'],
            'email' => $user['email'],
            'phone' => $user['phone'],
        ]);
        $checkout_session = $this->stripe->checkout->sessions->create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $Subscription['name'],
                            'description' => $Subscription['period'],
                        ],
                        'unit_amount' => $Subscription['price'] * 100,
                    ],
                    'quantity' => 1,
                ]
            ],
            'metadata' => [
                //subscription_period
                'subscription_id' => $Subscription['period'],
            ],
            'customer_email' => $user['email'],
            'mode' => 'payment',
            //Subscription_id
            'client_reference_id' => $Subscription['id'],
            'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('cancel'),
        ]);
        return $checkout_session->url;
    }

    public function cancel()
    {
        return "Payment is canceled.";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriptionDetailsRequest $request)
    {
        if (isset($request->session_id)) {

            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET', 'sk_test_51Q7zvlAKd03pxsFrF39kPa8qKdtfqRTZgVgdqsDKsZBkX8ue2YBTN951t8DOeoWhOd0658fI1S3v7BXqSrYTT0RN00RZnk4hEG'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);
            //user_id
            $user_id = Auth::user()->id;
            $request['user_id'] = $user_id;
            //subscription_id
            $subscription_id = $response->client_reference_id;
            $request['subscription_id'] = $subscription_id;
            //expiry_date
            $subscription_period = (int)$response->metadata['subscription_id'];
            $expiry_date = Carbon::now()->addMonths(value: $subscription_period);
            $Date = $expiry_date->format('Y-m-d');
            //insert_data
            $insert_data = SubscriptionDetails::create([
                'user_id' => $user_id,
                'subscription_id' => $subscription_id,
                'expiry_date' => $Date
            ]);

            return $this->response(code: 201, msg: "Payment is successful");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SubscriptionDetails $subscriptionDetails)
    {
        $id = $subscriptionDetails->id;
        $subscriptionDetails = SubscriptionDetails::with('user', 'subscription')->find($id);
        return $this->response(code: 200, data: $subscriptionDetails);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubscriptionDetails $subscriptionDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriptionDetailsRequest $request, SubscriptionDetails $subscriptionDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubscriptionDetails $subscriptionDetails)
    {
        //
    }
    public function delete(SubscriptionDetails $subscriptionDetails)
    {
        $delete = $subscriptionDetails->delete();
        return $this->response(code: 202, data: $delete);
    }
    public function deleted(SubscriptionDetails $subscriptionDetails)
    {
        $deleted = $subscriptionDetails->onlyTrashed()->get();
        return $this->response(code: 302, data: $deleted);
    }
    public function restore($subscriptionDetails)
    {
        $subscriptionDetails = SubscriptionDetails::withTrashed()->where('id', $subscriptionDetails)->restore();
        return $this->response(code: 202, data: $subscriptionDetails);
    }
    public function delete_from_trash($subscriptionDetails)
    {
        $subscriptionDetails = SubscriptionDetails::where('id', $subscriptionDetails)->forceDelete();
        return $this->response(code: 202, data: $subscriptionDetails);
    }
}
