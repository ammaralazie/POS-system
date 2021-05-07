<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable =
    [
        'name_ar',
        'discription_ar',
        'name_en',
        'discription_en',
        'image',
        'parchase_price',
        'sale_price',
        'stok',
        'category_id'

    ]; //end of fillable

    protected $appends=[
        'porfet_percent'
    ];//end of appends

    public function category()
    {
        return $this->belongsTo('App\Category');
    } //end category

    public function getImageAttribute($value){
        return asset('media/products_image/'.$value);
    }//end of get image

    public function getPorfetPercentAttribute(){
        $res=(( $this->sale_price-$this->parchase_price)*100)/120;
        if ($res<0){
            $res=0;
        }
        return $res;
    }
}
