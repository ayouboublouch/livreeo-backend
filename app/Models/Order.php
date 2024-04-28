<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['tracking_number', 'status'];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'order_articles')
            ->using(OrderArticle::class)
            ->withPivot('plastification','quantity');

    }


    public function totalPrice()
    {
        $totalPrice = 0;

        foreach ($this->articles as $orderArticle) {
            $totalPrice += $orderArticle->pivot->quantity * $orderArticle->price;
        }

        return $totalPrice;
    }
}
