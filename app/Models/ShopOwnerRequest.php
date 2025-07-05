<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopOwnerRequest extends Model
{
    protected $fillable = [
        'user_id',
        'business_name',
        'description',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
