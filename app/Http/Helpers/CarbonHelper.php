<?php

// Constants
use App\Constants\General;

// Carbon
use Carbon\Carbon;

/**
 * Concat two string.
 *
 * @param  string value
 * @param  string format (optional)
 * @return string|object
 */
function carbonDate($value,$format=null)
{
	$dateTime = Carbon::parse($value);

	if(!is_null($format))
		$dateTime = $dateTime->format($format);

	return $dateTime;
}

/**
 * Concat two string.
 *
 * @param  string format (optional)
 * @return string|object
 */
function currentCarbonDate($format=null)
{
	$dateTime = Carbon::now();

	if(!is_null($format))
		$dateTime = $dateTime->format($format);

	return $dateTime;
}

/**
 * Concat two string.
 *
 * @param  string date
 * @param  string filter
 * @return array
 */
function getDateRange($date=null,$filter=1,$date1=null)
{
	$SD = $ED = "";
	$format  = General::DATE_FORMAT_1;
	$customDate = $date ; 
	$date = carbonDate($date);

	if($filter==General::FILTER_WEEK)
	{
		$SD = carbonDate($date->startOfWeek(),$format);
		$ED = carbonDate($date->endOfWeek(),$format);
	}
	elseif($filter==General::FILTER_MONTH)
	{
		$SD = carbonDate($date->startOfMonth(),$format);
		$ED = carbonDate($date->endOfMonth(),$format);
	}
	elseif($filter==General::FILTER_YEAR)
	{
		$SD = carbonDate($date->startOfYear(),$format);
		$ED = carbonDate($date->endOfYear(),$format);
	}
	elseif($filter==General::FILTER_TODAY)
	{
		$SD = carbonDate($date->startOfDay(),$format);
		$ED = carbonDate($date->startOfDay(),$format);
	}
	elseif($filter==General::FILTER_THREEMONTH)
	{
		$startDate = \Carbon\Carbon::now();
		$endDate = \Carbon\Carbon::now();
		$endDate = $endDate->subMonth(3);
		$SD = carbonDate($endDate,$format);
		$ED = carbonDate($startDate,$format);
	}
	elseif($filter==General::FILTER_SIXMONTH)
	{
		$startDate = \Carbon\Carbon::now();
		$endDate = \Carbon\Carbon::now();
		$endDate = $endDate->subMonth(6);
		$SD = carbonDate($endDate,$format);
		$ED = carbonDate($startDate,$format);
	}
	elseif($filter==General::FILTER_NINEMONTH)
	{
		$startDate = \Carbon\Carbon::now();
		$endDate = \Carbon\Carbon::now();
		$endDate = $endDate->subMonth(9);
		$SD = carbonDate($endDate,$format);
		$ED = carbonDate($startDate,$format);
	}
	else
	{
		$startDate = ($customDate == null ) ?  \Carbon\Carbon::minValue()->isoFormat('MMM Do YYYY') : $customDate ;
		$endDate = ($date1 == null ) ? \Carbon\Carbon::maxValue()->isoFormat('MMM Do YYYY') : $date1;
		$SD = carbonDate($startDate,$format);
		$ED = carbonDate($endDate,$format);
	}
	return [$SD,$ED];
}