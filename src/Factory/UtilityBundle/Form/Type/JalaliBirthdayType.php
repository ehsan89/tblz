<?php 
namespace Factory\UtilityBundle\Form\Type;

use Factory\UtilityBundle\Utils\DateUtil;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class JalaliBirthdayType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
    	$from_year = DateUtil::date('Y', strtotime('-80 year'), false);
    	$to_year = DateUtil::date('Y', time(), false);
        $resolver->setDefaults(array(
            'years' => range($from_year, $to_year),
        ));
    }

    public function getParent()
    {
        return 'jalali_date_choice';
    }

    public function getName()
    {
        return 'jalali_birthday';
    }
}