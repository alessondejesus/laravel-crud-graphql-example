<?php

namespace App\Models;

use App\ModelFilters\ClientFilter;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasUuids, HasFactory, Filterable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
    ];

    public function modelFilter(): ?string
    {
        return $this->provideFilter(ClientFilter::class);
    }
}
