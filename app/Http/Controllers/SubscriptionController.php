<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\StoreWhereSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Subscription = Subscription::get();
        return $this->response(code: 200, data: $Subscription);

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
    public function store(StoreSubscriptionRequest $request)
    {
        $request = $request->validated();
        //insert data
        $insert = Subscription::create($request);
        if ($insert) {
            return $this->response(code: 201, data: $insert);
        } else {
            return $this->response(code: 400, data: 'Can\'t create ');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        $id = $subscription->id;
        $subscription = Subscription::with('subscription_details')->find($id);
        return $this->response(code: 200, data: $subscription);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriptionRequest $request, StoreWhereSubscriptionRequest $Subscription)
    {
        //validate
        $request = $request->validated();
        $Subscription = $Subscription->validated();
        $subscription_id = Subscription::all()->where('name', $Subscription['name_old'])->first()->id;
        //updata data;
        $update = DB::table('subscriptions')->where('id', $subscription_id)->update($request);
        //check if update
        if ($update) {
            return $this->response(code: 201, data: $update);
        } else {
            return $this->response(code: 201);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
    public function delete(Subscription $subscription)
    {
        $delete = $subscription->delete();
        return $this->response(code: 202, data: $delete);

    }
    public function deleted(Subscription $subscription)
    {
        $deleted = $subscription->onlyTrashed()->get();
        return $this->response(code: 302, data: $deleted);

    }
    public function restore($subscription)
    {
        $subscription = Subscription::withTrashed()->where('id', $subscription)->restore();
        return $this->response(code: 202, data: $subscription);

    }
    public function delete_from_trash($subscription)
    {
        $subscription = Subscription::where('id', $subscription)->forceDelete();
        return $this->response(code: 202, data: $subscription);

    }
}
