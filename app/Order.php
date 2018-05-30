<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'email',
        'city',
        'country',
        'product_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
