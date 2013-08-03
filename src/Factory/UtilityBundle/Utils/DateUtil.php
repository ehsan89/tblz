<?php

namespace Factory\UtilityBundle\Utils;

use Factory\UtilityBundle\Lib\jDateTime;

class DateUtil extends jDateTime{
	
	/**
	 * Get the DB DateTime representation of a date
	 * 
	 * @param unknown $date
	 * @param string $time
	 * @param string $jalali
	 * @param string $delimiter
	 * @return string
	 */
	public static function getDBDateTimeFromDate($date, $time = '00:00:00', $jalali = true, $delimiter = '/') {
		$date_array = explode($delimiter, $date);
		$db_date_array = $jalali ? DateUtil::toGregorian($date_array[0], $date_array[1], $date_array[2]) : $date_array;
		return $db_date_array[0].'-'.sprintf("%02d", $db_date_array[1]).'-'.sprintf("%02d", $db_date_array[2]).' '.$time;
	}
}