<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'user_name',
        'phone_number',
        'zip_code',
        'nationality',
        'gender',
        'referral_code',
        'address',
        'email',
        'refresh_token',
		'role_id',
		'password'
    ];

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var boolean
     */
    public $incrementing = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'refresh_token',
        'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:Y-m-d H:i:s'

    ];
	public function community()
	{
	 	  return $this->hasOne(Community::class,'discord_id','id');
	}
	public function UserStatus()
	{
	 	  return $this->hasOne(UserStatus::class,'id','user_status');
	}
	public function UserNote()
	{
	 	  return $this->hasOne(UserNote::class,'id','user_note');
	}
	public function getavatar($id,$avatar)
	{
		$basePath = env('DISCORD_IMAGE_URL');
		return $basePath . $id . "/" . $avatar . ".png";
	}
	public function getApplicationStatus()
	{
		$user = \Auth::user();
		$status = $user->community->status ;
		if($status == 0)
			return "Applied";
		else if($status == 1)
			return "Recurit";
		else if($status == 3)
			return "Rejected";
		else
			return "Other" ;
	}
	public function getRoleStatus($status)
	{
		if($status == 1)
			return "Guest";
		else if($status == 2)
			return "Recurit";
		else if($status == 3)
			return "Pending";
		else if($status == 4)
			return "Kicked";
		else if($status == 5)
			return "Active";
		else if($status == 6)
			return "Rejected";
		else if($status == 7)
			return "AFK";
		else if($status == 8)
			return "Left";
		else if($status == 9)
			return "Exodian";
		else
			return "Other" ;
	}
}
