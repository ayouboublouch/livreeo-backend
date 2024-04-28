<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'type', 'price', 'status', 'image_id', 'category_id'];

    public function image()
    {
        return $this->belongsTo(File::class, 'image_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function groups()
    {
        return $this->belongsToMany(Group::class, GroupArticle::class)
            ->withPivot('quantity');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_articles')
            ->using(OrderArticle::class)
            ->withPivot('quantity', 'plastification');
    }

}
