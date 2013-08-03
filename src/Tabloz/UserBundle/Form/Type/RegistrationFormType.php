<?php

namespace Tabloz\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType {
	public function buildForm(FormBuilderInterface $builder, array $options) {
		// parent builder
		$builder
				->add('username', null,
						array('label' => 'نام کاربری',
								'attr' => array(
										'placeholder' => 'username',
										'dir' => 'ltr')))
				->add('email', 'email',
						array('label' => 'ایمیل',
								'attr' => array(
										'placeholder' => 'name@example.com')))
				->add('plainPassword', 'repeated',
						array('type' => 'password',
								'first_options' => array(
										'label' => 'کلمه عبور',
										'attr' => array(
												'placeholder' => 'کلمه عبور')),
								'second_options' => array(
										'label' => 'تکرار کلمه عبور',
										'attr' => array(
												'placeholder' => 'تکرار کلمه عبور'))));

		// customization
		$builder
				->add('first_name', null,
						array('label' => 'نام',
								'attr' => array('placeholder' => 'نام')))
				->add('last_name', null,
						array('label' => 'نام خانوادگی',
								'attr' => array('placeholder' => 'نام خانوادگی')));
	}

	public function getName() {
		return 'tabloz_user_registration';
	}
}
