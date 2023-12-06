<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsImage extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'image_id',
        'image',
        'type'
    ];
}
