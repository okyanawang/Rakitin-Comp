<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ["name", "price", "weight", "stock", "description", "image", "categories_id"];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'categories_id');
    }

    public function orderdetails()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }
}
