<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingType extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'delay',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'shipping_type');
    }
}
