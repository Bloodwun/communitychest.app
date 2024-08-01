<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
		'status',
    ];
    public static function getRoleNamebyRoleId($role_id)
    {
        if($role_id == 1)
        {
            return 'Admin';
        }
        if($role_id == 2)
        {
            return 'staff';
        }
        if($role_id == 3)
        {
            return 'Business';
        }
        if($role_id == 4)
        {
            return 'Realtor/LeaseAgent';
        }
        if($role_id == 5)
        {
            return 'New Resident';
        }
        else
        {
            return '';
        }
    }
}
