<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionDetails;
use App\Trait\responsetrait as TraitResponsetrait;
use App\Trait\subscripetrait;
use Carbon\Carbon;
use Illuminate\Http\ResponseTrait;
use Illuminate\Support\Facades\Auth;


abstract class Controller
{
    use TraitResponsetrait;
    public function Subscripe()
    {
        $user_id = Auth::user()->id;
        $active_subscribtion = SubscriptionDetails::all()->where('user_id', $user_id)->where('expiry_date', '>=', Carbon::now());
        if (count($active_subscribtion) === 0) {
            return false;
        } else {
            return true;
        }
    }
}
