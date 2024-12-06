<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarmUp extends Model
{
    use HasFactory;
    protected $fillable = ['email','cycle','subject','description'];
}
