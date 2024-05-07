<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const PLASTIFICATION_PRICE = 15;

    protected $fillable = [
        'tracking_number',
        'status',
        'name',
        'phone',
        'email',
        'address',
        'city',
        'comment',
        'shipping_type',
        'promo_code',
        'reduction_rate',
    ];

    public function shippingType()
    {
        return $this->belongsTo(ShippingType::class, 'shipping_type');
    }

    public function variants()
    {
        return $this->belongsToMany(Variant::class, 'order_variants')
            ->using(OrderVariant::class)
            ->withPivot('plastification','quantity');

    }


    public function totalPrice()
    {
        $totalPrice = 0;

        foreach ($this->variants as $variant) {
            $totalPrice += $variant->pivot->quantity * ($variant->article->price + self::PLASTIFICATION_PRICE * $variant->pivot->plastification);
        }

        return $totalPrice * (1 - $this->reduction_rate);
    }
}
