<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplePay extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'payment_id',
        'token',
        'user_email',
        'amount',
        'currency',
        'description',
        'payment_status',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
