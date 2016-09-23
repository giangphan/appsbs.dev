<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = ['user_id','log'];

    public $timestamps = true;

    public function user(){
        return $this->belongTo(User::class);
    }

}
