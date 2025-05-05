<?php

namespace App\Models;

use App\ModelFilters\ProductFilter;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasUuids, HasFactory, Filterable;

    protected $fillable = [
        'name',
        'brand_id',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function modelFilter(): ?string
    {
        return $this->provideFilter(ProductFilter::class);
    }
}
