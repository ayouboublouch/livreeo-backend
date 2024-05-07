<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'school_id', 'school_list'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function schoolList()
    {
        return $this->belongsTo(File::class);
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, GroupArticle::class)
            ->withPivot('quantity');
    }
}
