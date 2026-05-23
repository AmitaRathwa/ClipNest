<?php

namespace App\Http\Controllers;
use App\Models\SubscriptionModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;


class Usersubscription extends Controller
{
    public function index()
    {

        // return view('users.pages.subscription');
         $subscriptions = SubscriptionModel::where('status', 0)
                            ->where('plan_status', 0)
                            ->orderBy('sub_id', 'DESC')
                            ->get();

        return view('users.pages.subscription', compact('subscriptions'));
    }



}

?>
