<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Brand extends Model
{
    use HasUuids, HasFactory;
    
    protected $fillable = [
        'name',
    ];
    
     public function products(): BelongsTo
    {
        return $this->hasMany(Product::class);
    }
}
