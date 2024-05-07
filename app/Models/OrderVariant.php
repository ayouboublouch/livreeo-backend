<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderVariant extends Pivot
{
    use HasFactory;

    protected $table = 'order_variants';

    protected $fillable = ['order_id','variant_id','plastification', 'quantity'];


    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    public function totalPrice()
    {
        return $this->quantity * $this->variant->article->price;
    }

}
