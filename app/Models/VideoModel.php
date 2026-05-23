<?php

namespace App\Models;
use App\Models\CategoryModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VideoModel extends Model
{
      use HasFactory;

    protected $table = 'tbl_movie';
    protected $primaryKey = 'movie_id';
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
      'category',
      'movie_name',
      'thumbnail',
      'video',
      'views',
      'created_by',
      'created_at',
      'updated_by',
      'updated_at',
       'status'
    ];


     public function categoryData()
    {
        return $this->belongsTo(CategoryModel::class, 'category', 'cat_id');
    }


}
