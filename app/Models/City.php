<?php

namespace App\Models;

use App\Models\School as ModelsSchool;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\School;


class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'postal_code'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function Schools()
    {
        return $this->hasMany(ModelsSchool::class);
    }
}
