<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GroupArticle extends Pivot
{

    protected $table = 'group_articles';
    protected $fillable = ['quantity']; 
}