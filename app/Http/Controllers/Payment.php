<?php

namespace App\Http\Controllers;
use App\Models\SubscriptionModel;
use App\Models\UserSubscriptionModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session; 

class Payment extends Controller
{
    public function index($id){
        $plan = SubscriptionModel::where('sub_id', $id)
                    ->where('status', 0)
                    ->firstOrFail();
        return view('users.pages.payment', compact('plan'));
    }
    public function paymentSuccess($id)
    {

        $plan = SubscriptionModel::find($id);

        $startDate = Carbon::now();

        $endDate = Carbon::now()->addMonths($plan->months);

        UserSubscriptionModel::create([

            'user_id' => Session::get('user_id'),

            'sub_id' => $plan->sub_id,

            'payment_id' => 'PAY_' . rand(10000,99999),

            'amount' => $plan->price,

            'start_date' => $startDate,

            'end_date' => $endDate,

            'payment_status' => 1,

            'status' => 0

        ]);

        return redirect()
                ->route('dashboard')
                ->with('success','Subscription Activated Successfully');
    }

}
