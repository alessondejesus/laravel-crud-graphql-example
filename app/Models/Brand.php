<?php

namespace App\Models;

use App\ModelFilters\BrandFilter;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Brand extends Model
{
    use HasUuids, HasFactory, Filterable;
    
    protected $fillable = [
        'name',
    ];
    
     public function products(): BelongsTo
    {
        return $this->hasMany(Product::class);
    }
    
    public function modelFilter(): ?string
    {
        return $this->provideFilter(BrandFilter::class);
    }
}
