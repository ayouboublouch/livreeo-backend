<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'status',
        'image',
        'category_id',
        'subcategory_id',
        'brand_id',
        'quantity',
        'weight',
        'color',  // added color field
        // add other fields as necessary
    ];
}
