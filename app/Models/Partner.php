<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'association_name',
        'school_name',
        'name',
        'surname',
        'phone_number',
        'function_in_association',
        'email',
        'message',
    ];

}
