<?php

namespace App\Http\Controllers;
use App\Models\CategoryModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\VideoModel;
use Illuminate\Support\Facades\Session;


class AddMovie extends Controller
{
    public function index()
    {
         $categories = CategoryModel::where('status', 0)->get();


        return view('admin.pages.video_clip',compact('categories'));
    }

 public function store(Request $request)
    {
        // Validation
        $request->validate([
            'category_id' => 'required',
            'movie_name'  => 'required',
            'thumbnail'   => 'required|image|mimes:jpg,jpeg,png',
            'video'       => 'required|mimes:mp4,mov,avi,mkv'
        ]);

        // Upload Thumbnail
        $thumbnailName = time().'_'.$request->thumbnail->getClientOriginalName();

        $request->thumbnail->move(
            public_path('uploads/thumbnails'),
            $thumbnailName
        );

        // Upload Video
        $videoName = time().'_'.$request->video->getClientOriginalName();

        $request->video->move(
            public_path('uploads/videos'),
            $videoName
        );

        // Save Data
        VideoModel::create([
            'category'   => $request->category_id,
            'movie_name' => $request->movie_name,
            'thumbnail'  => $thumbnailName,
            'video'      => $videoName,
            'created_by' => Session::get('admin_id'),
            'created_at' => now(),
            'status'     => 0
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Movie Added Successfully'
        ]);
    }
public function fetchVideo(Request $request)
{
    $query = VideoModel::join('category', 'category.cat_id', '=', 'tbl_movie.category')
        ->where('tbl_movie.status', 0)
        ->select(
            'tbl_movie.*',
            'category.category_name'
        )
        ->orderBy('tbl_movie.movie_id', 'desc');

    // Total Count
    $totalData = $query->count();
    $totalFiltered = $totalData;

    // Search
    $searchValue = $request->input('search.value');

    if (!empty($searchValue)) {

        $query->where(function ($q) use ($searchValue) {

            $q->where('tbl_movie.movie_name', 'LIKE', "%{$searchValue}%")
              ->orWhere('category.category_name', 'LIKE', "%{$searchValue}%");

        });
    }

    $totalFiltered = $query->count();

    // Pagination
    $limit = $request->input('length', 10);
    $start = $request->input('start', 0);

    $query->offset($start)->limit($limit);

    // Fetch Data
    $videos = $query->get();

    // Format Data
    $formattedData = [];

    $sr_no = $start + 1;

    foreach ($videos as $video) {

        $thumbnail = '
            <img src="' . asset('uploads/thumbnails/' . $video->thumbnail) . '"
                 width="70"
                 height="70">
        ';

        $videoLink = '
            <a href="' . asset('uploads/videos/' . $video->video) . '"
               target="_blank"
               class="text-blue-500 hover:underline">
               Open Video
            </a>
        ';

           $actionButtons = '
    <button class="text-fuchsia-500 editBtn"
        data-id="' . $video->movie_id . '"
        data-category="' . $video->category . '"
        data-name="' . $video->movie_name . '"
        data-thumbnail="' . $video->thumbnail . '"
        data-video="' . $video->video . '">
        Edit
    </button>

    <button class="text-red-500 deleteBtn ml-2"
        data-id="' . $video->movie_id . '">
        Delete
    </button>
';

        $formattedData[] = [

            'sr_no' => $sr_no++,

            'category_name' => $video->category_name,

            'movie_name' => $video->movie_name,

            'thumbnail' => $thumbnail,

            'video_link' => $videoLink,

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
    $movie = VideoModel::find($id);

    // Thumbnail Upload
    if ($request->hasFile('thumbnail')) {

        $thumbnailName = time().'_'.$request->thumbnail->getClientOriginalName();

        $request->thumbnail->move(
            public_path('uploads/thumbnails'),
            $thumbnailName
        );

        $movie->thumbnail = $thumbnailName;
    }

    // Video Upload
    if ($request->hasFile('video')) {

        $videoName = time().'_'.$request->video->getClientOriginalName();

        $request->video->move(
            public_path('uploads/videos'),
            $videoName
        );

        $movie->video = $videoName;
    }

    // Update Data
    $movie->category = $request->category_id;

    $movie->movie_name = $request->movie_name;

    $movie->updated_by = Session::get('admin_id');

    $movie->updated_at = now();

    $movie->save();

    return response()->json([
        'success' => true,
        'message' => 'Movie Updated Successfully'
    ]);
}


public function delete($id)
{
    $movie = VideoModel::find($id);

    if (!$movie) {

        return response()->json([
            'success' => false,
            'message' => 'Movie not found'
        ]);
    }

    // Soft Delete using status
    $movie->status = 1;

    $movie->updated_by = Session::get('admin_id');

    $movie->updated_at = now();

    $movie->save();

    return response()->json([
        'success' => true,
        'message' => 'Movie Deleted Successfully'
    ]);
}



}



?>
