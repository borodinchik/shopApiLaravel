<?php

namespace App;

use App\Http\Controllers\ManufacturerController;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable =
        [
            'title',
            'description',
            'price',
            'company_id',
        ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }
    
}
