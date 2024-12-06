<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'business_id',
        'name',
        'price',
        
    ];
    public function user()
{
    return $this->belongsTo(User::class, 'business_id');
}

}
