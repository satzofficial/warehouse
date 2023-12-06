<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'sku',
        'unit',
        'dimensions',
        'manufacture',
        'upc',
        'ean',
        'weight',
        'brand',
        'mpn',
        'isbn',
        'selling_price',
        'account',
        'description',
        'cost_price',
        'purchase_account',
        'purchase_description',
        'preferred_vendor',
        'opening_stock',
        'opening_stock_rate_per_unit',
        'reorder_point',
    ];

}
