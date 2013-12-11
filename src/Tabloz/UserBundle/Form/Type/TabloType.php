<?php
namespace Tabloz\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class TabloType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('title', null, array('label' => 'عنوان',
								'attr' => array('placeholder' => 'عنوان')));
		$builder->add('description', 'textarea', array('label' => 'توضیحات', 'required' => false,
								'attr' => array('placeholder' => 'توضیحات بیشتر را درباره این اثر بنویسید ...')));
		$builder->add('category', null, array('label' => 'دسته بندی'));
		$builder->add('print_markup_percent', null, array('label' => 'میزان سود  نسبت به قیمت پایه نسخه چاپ شده', 'data' => 100));
		$builder->add('download_markup_percent', null, array('label' => 'میزان سود نسبت به قیمت پایه دانلود', 'data' => 100));
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => 'Tabloz\MainBundle\Entity\Tablo',
		));
	}

	public function getName()
	{
		return 'tablo';
	}
}