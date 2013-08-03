<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Tabloz\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Sonata\UserBundle\Form\Type\ProfileType as BaseType;

class ProfileFormType extends BaseType
{
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
				->add('firstname', null,
						array(	'label' => 'نام',
								'attr' => array(
										'placeholder' => 'نام')))
				->add('lastname', null,
						array(	'label' => 'نام خانوادگی',
								'attr' => array(
										'placeholder' => 'نام خانوادگی')))
				->add('email', 'email',
						array(	'label' => 'ایمیل',
								'attr' => array(
										'placeholder' => 'name@example.com')))
	            ->add('gender', 'gender', array('required' => false, 'label' => 'جنسیت'))
	            ->add('dateOfBirth', 'jalali_birthday', array('required' => false, 'label' => 'تاریخ تولد'))
	            ->add('website', 'url',
						array(	'label' => 'وبسایت',
								'required' => false,
								'attr' => array(
										'placeholder' => 'http://www.tabloz.com')))
            	->add('biography', 'textarea',
						array(	'label' => 'بیوگرافی',
								'required' => false,
								'attr' => array(
										'placeholder' => 'بیوگرافی')))
				->add('phone', null,
						array(	'label' => 'شماره تلفن',
								'required' => false,
								'attr' => array(
										'placeholder' => 'شماره تلفن')))
				->add('mobile', null,
						array(	'label' => 'شماره همراه',
								'required' => false,
								'attr' => array(
										'placeholder' => 'شماره همراه')))
				->add('address', null,
						array(	'label' => 'آدرس',
								'required' => false,
								'attr' => array(
										'placeholder' => 'آدرس')))
				->add('postalCode', null,
						array(	'label' => 'کد پستی',
								'required' => false,
								'attr' => array(
										'placeholder' => 'کد پستی')))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'tabloz_user_profile';
    }
}
