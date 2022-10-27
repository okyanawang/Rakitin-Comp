<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'component_category';
    protected $primaryKey = 'cc_id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ["cc_name","cc_description"];

    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }
}
