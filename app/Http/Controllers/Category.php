<?php

namespace App\Http\Controllers;
use App\Models\CategoryModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Session;


class Category extends Controller
{
    public function index()
    {

        return view('admin.pages.category');
    }

//    public function store(Request $request)
//     {
//         $request->validate([
//             'category_name' => 'required|max:255',
//         ]);

//         $category = CategoryModel::create([
//             'category_name' => $request->category_name,
//             'created_at' => now(),

//             'created_by' => Session::get('admin_id'),

//         ]);

//         return response()->json([
//             'status' => true,
//             'message' => 'Category Added Successfully',
//             'data' => $category
//         ]);
//     }


public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'category_name' => 'required|max:255',
    ], [
        'category_name.required' => 'Category name is required',
        'category_name.max' => 'Category name must not exceed 255 characters',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validation Error',
            'errors' => $validator->errors()
        ], 422);
    }

    $category = CategoryModel::create([
        'category_name' => $request->category_name,
        'created_at' => now(),
        'created_by' => Session::get('admin_id'),
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Category Added Successfully',
        'data' => $category
    ]);
}

    public function fetch()
    {
        $categories = CategoryModel::orderBy('cat_id', 'desc')->get();

        return response()->json([
            'status' => true,
            'data' => $categories
        ]);
    }
public function update(Request $request, $id)
{
    $category = CategoryModel::find($id);

    $category->category_name = $request->category_name;
     $category->updated_by = Session::get('admin_id');
      $category->updated_at = now();

    $category->save();

    return response()->json([
        'status' => true,
        'message' => 'Category Updated Successfully'
    ]);
}


public function delete($id)
{
    $category = CategoryModel::find($id);

    if (!$category) {
        return response()->json([
            'status' => false,
            'message' => 'Category not found'
        ]);
    }

    $category->status = 1; // soft delete
    $category->save();

    return response()->json([
        'status' => true,
        'message' => 'Category deleted successfully'
    ]);
}

}

?>
