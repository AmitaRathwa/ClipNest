<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Category;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $primaryKey = 'cat_id';
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
      'category_name',
      'created_at',
      'updated_at',
       'created_by',
       'updated_by',
       'status'


    ];
}
