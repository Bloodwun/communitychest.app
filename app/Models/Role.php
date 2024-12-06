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
    
    const OWNER_ROLE = 1;
    const ADMIN_ROLE = 2;
    const STAFF_ROLE = 3;
    const BUSINESS_ROLE = 4;
    const BUSINESS_STAFF_ROLE = 5;
    const PROPERTY_MANAGER_ROLE = 6;
    const PROPERTY_STAFF_ROLE = 7;
    const RESIDENT_ROLE = 8;

   


   
    public static function getRoleNamebyRoleId($role_id)
    {
       
        if ($role_id == 1) {
            return 'Owner';
        }
        if ($role_id == 2) {
            return 'Admin';
        }
        if ($role_id == 3) {
            return 'staff';
        }
        if ($role_id == 4) {
            return 'Business';
        }
        if ($role_id == 5) {
            return 'Business_staff';
        }
        if ($role_id == 6) {
            return 'Property Manager';
        }
        if ($role_id == 7) {
            return 'New Resident';
        }
        if ($role_id ==8) {
            return 'New Resident';
        }
       else {
            return '';
        }
    }
}
