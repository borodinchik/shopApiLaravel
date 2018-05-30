<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Manufacturer extends Model
{
//    public $primaryKey = ['id'];
    protected $fillable = ['company'];
    //public $hidden = [];
    protected $table = 'manufacturers';
//    public $timestamps = true;

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}


