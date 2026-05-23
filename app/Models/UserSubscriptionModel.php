<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubscriptionModel extends Model
{
    protected $table = 'tbl_user_subscription';

    protected $primaryKey = 'user_sub_id';

    protected $fillable = [

        'user_id',
        'sub_id',
        'payment_id',
        'amount',
        'start_date',
        'end_date',
        'payment_status',
        'status'

    ];
}
