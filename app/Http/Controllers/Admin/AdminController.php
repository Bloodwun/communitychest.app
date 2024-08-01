<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailMarketing;
use Illuminate\Support\Facades\Auth;
use Aws\Ses\SesClient;

class AdminController extends Controller
{
	public function root()
	{

		if (!Auth::check())
			return view('user.login');
		if (Auth::user()->role_id == 1)
		{
            $stats = [];//self::getEmailStats();
			return view('admin.dashboard')->with(['stats'=>$stats]);
		}
		return view('user.login');
	}
}
