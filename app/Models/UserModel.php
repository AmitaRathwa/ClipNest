<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserModel extends Model
{
     use HasFactory;

    protected $table = 'tbl_user';
    protected $primaryKey = 'user_id';
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false;
    protected $fillable = [
      'name',
      'email',
      'password',
      'created_at',
       'updated_by',
      'updated_at',
       'status'


    ];
}
