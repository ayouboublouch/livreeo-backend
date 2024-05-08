<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    protected $table = 'variants';

    protected $fillable = ['article_id','color','image_id', 'status'];


    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_variants')
            ->using(OrderVariant::class)
            ->withPivot('plastification','quantity');
    }

    public function image()
    {
        return $this->belongsTo(File::class, 'image_id');
    }

}
