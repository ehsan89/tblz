<?php
namespace Factory\UtilityBundle\Twig;

class UtilityExtension extends \Twig_Extension
{
	public function getFunctions()
	{
		return array(
				'spacer' => new \Twig_Function_Method($this, 'spacer'),
		);
	}

	/**
	 * Prints a number of white spaces
	 * @param int $number
	 */
	public function spacer($number)
	{
		for ($i=0;$i<$number;$i++){
			echo '&nbsp';
		}
	}

	public function getName()
	{
		return 'utility_extension';
	}
}