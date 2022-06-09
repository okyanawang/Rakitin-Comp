<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'component';
    protected $primaryKey = 'c_id';
    protected $fillable = ["c_img", "c_description", "c_price", "c_qty", "cc_id", "b_id"];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'categories_id');
    }
}
