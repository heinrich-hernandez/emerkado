<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariety extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'variety_code',
        'price',
        'description',
        'stock_quantity',
        'is_active',
    ];
}
