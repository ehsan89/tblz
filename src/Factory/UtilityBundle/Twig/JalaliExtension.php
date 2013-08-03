<?php
namespace Factory\UtilityBundle\Twig;

use Factory\UtilityBundle\Utils\DateUtil;

class JalaliExtension extends \Twig_Extension
{
	public function getFilters()
	{
		return array(
				'jalali_date' => new \Twig_Filter_Method($this, 'jalaliDateFilter'),
				'jalali_date_time' => new \Twig_Filter_Method($this, 'jalaliDateTimeFilter'),
				'jalali_date_formatted' => new \Twig_Filter_Method($this, 'jalaliDateFormattedFilter'),
				'jalali_date_time_formatted' => new \Twig_Filter_Method($this, 'jalaliDateTimeFormattedFilter'),
		);
	}

	public function jalaliDateFilter($gdate, $delimiter = '/')
	{
		$gdate = is_string($gdate) ? $gdate : $gdate->format('Y-m-d');
		return DateUtil::date('Y'.$delimiter.'m'.$delimiter.'d', strtotime($gdate));
	}

	public function jalaliDateTimeFilter($gdate_time, $delimiter = '/')
	{
		$gdate_time = is_string($gdate_time) ? $gdate_time : $gdate_time->format('Y-m-d H:i:s');
		return DateUtil::date('Y'.$delimiter.'m'.$delimiter.'d H:i', strtotime($gdate_time));
	}

	public function jalaliDateFormattedFilter($gdate)
	{
		$gdate = is_string($gdate) ? $gdate : $gdate->format('Y-m-d');
		$timestamp = strtotime($gdate);
		$current_year = date('Y');
		$timestamp_year = date('Y', $timestamp);
		if ($timestamp_year == $current_year) {
			return DateUtil::date("l F j", $timestamp);
		} else {
			return DateUtil::date("F j Y", $timestamp);
		}
	}

	public function jalaliDateTimeFormattedFilter($gdate_time)
	{
		$gdate_time = is_string($gdate_time) ? $gdate_time : $gdate_time->format('Y-m-d H:i:s');
		$timestamp = strtotime($gdate_time);
		$current_year = DateUtil::date('Y');
		$timestamp_year = DateUtil::date('Y', $timestamp);
		if ($timestamp_year == $current_year) {
			return DateUtil::date("l j F، G:i", $timestamp);
		} else {
			return DateUtil::date("j F Y، G:i", $timestamp);
		}
	}

	public function getName()
	{
		return 'jalali_extension';
	}
}