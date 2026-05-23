<?php

namespace App\Http\Controllers;
use App\Models\CategoryModel;
use App\Models\VideoModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\UserSubscriptionModel;
use Illuminate\Support\Facades\Session;



class UserDashbord extends Controller
{
    public function index()
    {

        // return view('users.pages.user_dashbord');

     $videos = VideoModel::join(
                'category',
                'category.cat_id',
                '=',
                'tbl_movie.category'
            )
            ->where('tbl_movie.status', 0)
            ->select(
                'tbl_movie.*',
                'category.category_name'
            )
            ->latest('tbl_movie.movie_id')
            // ->orderBy('tbl_movie.movie_id', 'desc')
            ->take(8)
            ->get();

              // MOST PLAYED VIDEOS
    $mostPlayed = VideoModel::with('categoryData')
                    ->where('status',0)
                    ->orderBy('views','desc')
                    ->take(6)
                    ->get();


        $activePlan = null;

        if(Session::has('user_id')){

            $activePlan = UserSubscriptionModel::where(
                                'user_id',
                                Session::get('user_id')
                            )
                            ->where('payment_status', 1)
                            ->where(
                                'end_date',
                                '>=',
                                Carbon::today()
                            )
                            ->first();
        }


$topCategories = CategoryModel::where('status',0)
    ->get()
    ->map(function($category){

        $latestVideo = VideoModel::where('category',$category->cat_id)
            ->where('status',0)
            ->latest('movie_id')
            ->first();

        $category->latest_thumbnail = $latestVideo
            ? $latestVideo->thumbnail
            : 'default.jpg';

        return $category;

    });


        return view(
            'users.pages.user_dashbord',
            compact('videos','activePlan','mostPlayed','topCategories')
        );


    }

public function watchVideo($id)
{

    $video = VideoModel::find($id);

    if(!$video){

        return response()->json([
            'success' => false
        ]);

    }

    $video->views = $video->views + 1;

    $video->save();

    return response()->json([
        'success' => true,
        'views' => $video->views
    ]);

}

}

?>
