<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        "id",
        "title",
        "price",
        "description",
        "category",
        "image",
        "rate",
        "count"
    ];

    protected $hidden = [
    ];

    protected $casts = [
    ];

}
