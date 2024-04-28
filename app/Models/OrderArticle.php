<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderArticle extends Pivot
{
    use HasFactory;

    protected $table = 'order_articles';

    protected $fillable = ['order_id','article_id','plastification', 'quantity'];


    public function totalPrice()
    {
        return $this->quantity * $this->article->price;
    }

}
