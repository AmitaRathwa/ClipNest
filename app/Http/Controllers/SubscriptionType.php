<?php

namespace App\Http\Controllers;
use App\Models\SubscriptionModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;


class SubscriptionType extends Controller
{
    public function index()
    {

        return view('admin.pages.subscription_types');
    }

public function store(Request $request)
{
    // Validation
    $request->validate([

        'sub_plan' => 'required|max:255',

        'months' => 'required|numeric|min:1',

        'price' => 'required|numeric|min:0',

        'discount' => 'nullable|numeric|min:0|max:100',

        'description' => 'nullable',

        'plan_status' => 'required'

    ]);

    // Store Data
    $subscription = SubscriptionModel::create([

        'sub_plan' => $request->sub_plan,

        'months' => $request->months,

        'price' => $request->price,

        'discount' => $request->discount ?? 0,

        'description' => $request->description,

        'plan_status' => $request->plan_status,

        'created_at' => now(),

        'created_by' => Session::get('admin_id'),

        'status' => 0

    ]);

    return response()->json([

        'success' => true,

        'message' => 'Subscription Plan Added Successfully',

        'data' => $subscription

    ]);
}


public function fetchSubscription(Request $request)
{
    $query = SubscriptionModel::where('status', 0)
        ->orderBy('sub_id', 'desc');

    // Total Count
    $totalData = $query->count();

    $totalFiltered = $totalData;

    // Search
    $searchValue = $request->input('search.value');

    if (!empty($searchValue)) {

        $query->where(function ($q) use ($searchValue) {

            $q->where('sub_plan', 'LIKE', "%{$searchValue}%")
              ->orWhere('months', 'LIKE', "%{$searchValue}%")
              ->orWhere('price', 'LIKE', "%{$searchValue}%");

        });
    }

    // Filtered Count
    $totalFiltered = $query->count();

    // Pagination
    $limit = $request->input('length', 10);

    $start = $request->input('start', 0);

    $query->offset($start)->limit($limit);

    // Fetch Data
    $subscriptions = $query->get();

    $formattedData = [];

    $sr_no = $start + 1;

    foreach ($subscriptions as $subscription) {

        // Status Badge
        if ($subscription->plan_status == 0) {

            $statusBadge = '
                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs">
                    Active
                </span>
            ';

        } else {

            $statusBadge = '
                <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs">
                    Inactive
                </span>
            ';
        }

        // Action Buttons
       $actionButtons = '
    <button class="text-fuchsia-500 hover:underline text-sm editBtn"

        data-id="' . $subscription->sub_id . '"

        data-plan="' . $subscription->sub_plan . '"

        data-months="' . $subscription->months . '"

        data-price="' . $subscription->price . '"

        data-discount="' . $subscription->discount . '"

        data-description="' . $subscription->description . '"

        data-status="' . $subscription->plan_status . '">

        Edit

    </button>

    <button class="text-red-500 hover:underline text-sm deleteBtn ml-2"

        data-id="' . $subscription->sub_id . '">

        Delete

    </button>
';

        $formattedData[] = [

            'sr_no' => $sr_no++,

            'sub_plan' => $subscription->sub_plan,

            'months' => $subscription->months . ' Month',

            'price' => '₹ ' . $subscription->price,

            'discount' => $subscription->discount . '%',

            'plan_status' => $statusBadge,

            'actions' => $actionButtons,

        ];
    }

    // Return JSON
    return response()->json([

        "draw" => intval($request->input('draw')),

        "recordsTotal" => $totalData,

        "recordsFiltered" => $totalFiltered,

        "data" => $formattedData,

    ]);
}

public function update(Request $request, $id)
{
    $request->validate([

        'sub_plan' => 'required|max:255',

        'months' => 'required|numeric|min:1',

        'price' => 'required|numeric|min:0',

        'discount' => 'nullable|numeric|min:0|max:100',

        'description' => 'nullable',

        'plan_status' => 'required'

    ]);

    $subscription = SubscriptionModel::find($id);

    if (!$subscription) {

        return response()->json([
            'success' => false,
            'message' => 'Subscription not found'
        ]);
    }

    $subscription->sub_plan = $request->sub_plan;

    $subscription->months = $request->months;

    $subscription->price = $request->price;

    $subscription->discount = $request->discount;

    $subscription->description = $request->description;

    $subscription->plan_status = $request->plan_status;

    $subscription->updated_at = now();

    $subscription->updated_by = Session::get('admin_id');

    $subscription->save();

    return response()->json([

        'success' => true,

        'message' => 'Subscription Updated Successfully'

    ]);
}

public function delete($id)
{
    $subscription = SubscriptionModel::find($id);

    if (!$subscription) {

        return response()->json([

            'success' => false,

            'message' => 'Subscription Plan Not Found'

        ]);
    }

    // Soft Delete
    $subscription->status = 1;

    $subscription->updated_at = now();

    $subscription->updated_by = Session::get('admin_id');

    $subscription->save();

    return response()->json([

        'success' => true,

        'message' => 'Subscription Plan Deleted Successfully'

    ]);
}

}

?>
