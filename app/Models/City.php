<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\School;


class City extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'country'];

    public function Schools()
    {
        return $this->hasMany(School::class);
    }
}
