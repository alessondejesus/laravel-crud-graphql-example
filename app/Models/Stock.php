<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'product_id',
        'amount',
        'unit_type',
    ];
}
