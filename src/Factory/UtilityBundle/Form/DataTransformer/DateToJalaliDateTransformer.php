<?php
namespace Factory\UtilityBundle\Form\DataTransformer;

use Factory\UtilityBundle\Utils\DateUtil;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;

class DateToJalaliDateTransformer implements DataTransformerInterface
{
	/**
	 * @var string date data type
	 */
	private $type;
	
	/**
	 * @var string date delimiter
	 */
	private $delimiter;

	/**
	 * @param string $type date type ('array' or 'text')
	 * @param string $delimiter date delimiter
	 */
	public function __construct($type='array', $delimiter='-')
	{
		$this->type = $type;
		$this->delimiter = $delimiter;
	}

	/**
	 * Transforms an gregorian date to a jalali date.
	 *
	 * @param  $date
	 * @return string
	 */
	public function transform($date)
	{
		if (null === $date) {
			if ($this->type == 'array'){
				return array('year' => '', 'month' => '', 'day' => '');
			} elseif ($this->type == 'text'){
				return '';
			}
		}

		try {
			$jdate = DateUtil::date('Y'.$this->delimiter.'m'.$this->delimiter.'d', strtotime($date->format("Y-m-d")), false);
		} catch (\Exception $e) {
			throw new TransformationFailedException($e->getMessage(), $e->getCode(), $e);
		}
		
		if ($this->type == 'array'){
			$jarray = explode($this->delimiter, $jdate);
			return array('year' => $jarray[0], 'month' => ltrim($jarray[1], '0'), 'day' => ltrim($jarray[2], '0'));
		} elseif ($this->type == 'text'){
			return $jdate;
		}
	}

	/**
	 * Transforms a jalali date to a gregorian date.
	 *
	 * @param  array $jdate
	 *
	 * @return string
	 */
	public function reverseTransform($jdate)
	{
		if (!$jdate) {
			return null;
		}

		try {
			if (is_array($jdate)){

				if (!isset($jdate['year']) || !isset($jdate['month']) || !isset($jdate['day'])) {
					throw new TransformationFailedException('تاریخ را کامل وارد کنید');
				}
				
				if (isset($jdate['year']) && !ctype_digit($jdate['year']) && !is_int($jdate['year'])) {
					throw new TransformationFailedException('سال معتبر نیست');
				}
				
				if (isset($jdate['month']) && !ctype_digit($jdate['month']) && !is_int($jdate['month'])) {
					throw new TransformationFailedException('ماه معتبر نیست');
				}
				
				if (isset($jdate['day']) && !ctype_digit($jdate['day']) && !is_int($jdate['day'])) {
					throw new TransformationFailedException('روز معتبر نیست');
				}
				
				if (!empty($jdate['month']) && !empty($jdate['day']) && !empty($jdate['year']) && false === DateUtil::checkdate($jdate['month'], $jdate['day'], $jdate['year'])) {
					throw new TransformationFailedException('این تاریخ معتبر نیست');
				}
				
				$gdate_array = DateUtil::toGregorian($jdate['year'], $jdate['month'], $jdate['day']);
			} else {
				$jarray = explode($this->delimiter, $jdate);
				$gdate_array = DateUtil::toGregorian($jarray[0], $jarray[1], $jarray[2]);
			}

		} catch (\Exception $e) {
			throw new TransformationFailedException($e->getMessage(), $e->getCode(), $e);
		}
		
		return new \DateTime($gdate_array[0].'-'.$gdate_array[1].'-'.$gdate_array[2]);
	}
}