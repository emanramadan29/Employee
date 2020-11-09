<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $fillable=['img','product_id'];

    public function product(){
        $this->belongsTo('App\Model\Product');
    }
}
