<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'city',
        'post_id',
        'cv',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function cv()
    {
        return $this->belongsTo(File::class, 'cv');
    }

}
