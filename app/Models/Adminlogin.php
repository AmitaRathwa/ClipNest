<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Adminlogin extends Model
{
    use HasFactory;

    protected $table = 'tbl_admin';

    protected $primaryKey = 'admin_id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'mobile_no',
        'password',
    ];
}
