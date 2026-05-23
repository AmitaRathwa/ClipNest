<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriptionModel extends Model
{
   protected $table = 'tbl_subscription';
    protected $primaryKey = 'sub_id';
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
      'sub_plan',
      'months',
      'price',
      'discount',
      'description',
      'plan_status',
      'created_at',
      'created_by',
      'updated_at',
       'updated_by',
       'status'


    ];
}
