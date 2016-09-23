<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Status;
use App\User;
use App\Detail;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['code','customer','phone','address','email','class','payment','shipping','total','deposit','orderDate','note','status_id','user_id'];

    public $timestamps = true;

    public function detail() {
        return $this->hasMany(Detail::class);
    }

    public function status() {
        return $this->hasOne(Status::class,'id','status_id');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
