<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = 'details';

    protected $fillable = ['product_id','order_id','name','quantity','price'];

    public $timestamps = false;

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
