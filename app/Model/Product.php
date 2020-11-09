<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['name','price','img','description'];

    public function productImages(){
        $this->hasMany('App\Model\ProductImages','product_id','id');
    }
}
