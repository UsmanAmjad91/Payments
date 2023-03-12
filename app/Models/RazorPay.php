<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RazorPay extends Model
{
    use HasFactory;

    use HasFactory;
    protected $fillable = [
        'user_id',
        'user_email',
        'amount',
        'name',
        'token',
        'description',
        'payment_status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
