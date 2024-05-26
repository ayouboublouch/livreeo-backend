<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GroupLanguageArticle extends Pivot
{

    protected $table = 'group_language_articles';
    protected $fillable = ['quantity']; 
}