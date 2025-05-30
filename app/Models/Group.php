<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'school_id', 'level', 'status'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function languages()
    {
        return $this->hasMany(GroupLanguage::class);
    }
}
