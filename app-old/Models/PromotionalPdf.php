<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionalPdf extends Model
{
    use HasFactory;

    // Define fillable fields to allow mass assignment
    protected $fillable = [
        'user_id',
        'logo',
        'banner',
        'promotional_detail',
        'term_n_conditions',
        'coupon_code',
        'start_date',
        'expiration_date',
        'layout',
        'img1', 'img2', 'img3', 'img4', 'img5', 
        'img6', 'img7', 'img8', 'img9', 'img10',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
