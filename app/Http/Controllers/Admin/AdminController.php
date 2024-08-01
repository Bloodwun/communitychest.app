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
    protected function getEmailStats()
    {
        $client = new SesClient([
            'version' => 'latest',
            'region' => "us-east-1",
            'credentials' => [
                'key' => "AKIASNKB2SQEOPDF3LPR",
                'secret' => "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",
            ],
        ]);
        $deliveryAttempts = 0;
        $sendAttempts = 0;
        $deliveryRate = 0;
        $totalBounces = 0;
        $totalSent = 0;
        $bounceRate = 0 ;
        $totalComplaints = 0;
        $spamComplaintRate = 0 ;

        $response = $client->getSendStatistics();
        $sendDataPoints = $response->get('SendDataPoints');
        foreach ($sendDataPoints as $dataPoint)
        {
            $totalBounces += $dataPoint['Bounces'];
            $totalComplaints += $dataPoint['Complaints'];
            $totalSent += $dataPoint['DeliveryAttempts'];
            $deliveryAttempts += $dataPoint['DeliveryAttempts'];
            $sendAttempts += $dataPoint['Complaints'] + $dataPoint['Rejects'] + $dataPoint['Bounces'] + $dataPoint['DeliveryAttempts'];
        }
        if ($sendAttempts > 0)
        {
            $deliveryRate = $deliveryAttempts / $sendAttempts;
        }
        $deliveryRatePercentage = $deliveryRate * 100;
        if ($totalSent > 0) {
            $bounceRate = ($totalBounces / $totalSent) * 100;
            $spamComplaintRate = ($totalComplaints / $totalSent) * 100;
        }
        // END
        $jobClassName = 'App\\Jobs\\WarmupEmailJob';
        return
        [

            'total_marketing_emails_opened' => EmailMarketing::whereNotNull('opened_at')->count(),
            'total_marketing_emails_sent'=> EmailMarketing::count(),
            'delivery_rate' => round($deliveryRatePercentage,2),
            'bounce_rate'   => round($bounceRate,2),
            'complaint_rate'    => round($spamComplaintRate,2),
            'marketingEmailCounter' => \DB::table("jobs")->where('reserved_at', null)->whereJsonDoesntContain('payload', ['displayName' => $jobClassName])->count(),
            'isWarmupRunning' => \DB::table('jobs')->whereJsonContains('payload', ['displayName' => $jobClassName])->count()
        ];
    }
}
