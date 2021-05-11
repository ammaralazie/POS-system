<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['total_price'];
    //end of fillable


    public function client(){
        return $this->belongsTo(Client::class);
    }//end of user

    public function product(){
        return $this->belongsToMany(Product::class,'prduct_order');
    }//end of product

}
