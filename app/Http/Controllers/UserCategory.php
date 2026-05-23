<?php

namespace App\Http\Controllers;
use App\Models\CategoryModel;
use App\Models\VideoModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\UserSubscriptionModel;

use Illuminate\Support\Facades\Session;


class UserCategory extends Controller
{
    public function index()
    {

         $categories = CategoryModel::where('status',0)->get();

    $videos = VideoModel::with('categoryData')
                ->where('status',0)
                ->get();


     // CHECK ACTIVE SUBSCRIPTION

        $activePlan = null;

        if(Session::has('user_id')){

            $activePlan = UserSubscriptionModel::where('user_id',Session::get('user_id'))
                            ->where('payment_status',1)
                            ->where('end_date','>=',Carbon::today())
                            ->first();

        }

    return view('users.pages.category', compact('categories','videos','activePlan'));
        // return view('users.pages.category');
    }
    public function categoryVideos($id)
{
    $categories = CategoryModel::where('status',0)->get();

    $videos = VideoModel::with('categoryData')
                ->where('category',$id)
                ->where('status',0)
                ->get();

    $currentCategory = CategoryModel::find($id);


     // CHECK ACTIVE SUBSCRIPTION

        $activePlan = null;

        if(Session::has('user_id')){

            $activePlan = UserSubscriptionModel::where('user_id',Session::get('user_id'))
                            ->where('payment_status',1)
                            ->where('end_date','>=',Carbon::today())
                            ->first();

        }

    return view(
        'users.pages.category_video',
        compact('videos','categories','currentCategory','activePlan')
    );
}


}

?>
