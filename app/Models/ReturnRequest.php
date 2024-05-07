<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'email',
        'type',
        'comment',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}