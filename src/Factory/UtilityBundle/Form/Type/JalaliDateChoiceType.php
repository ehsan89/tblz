<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Factory\UtilityBundle\Form\Type;

use Factory\UtilityBundle\Utils\DateUtil;

use Factory\UtilityBundle\Form\DataTransformer\DateToJalaliDateTransformer;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToLocalizedStringTransformer;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToArrayTransformer;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToTimestampTransformer;
use Symfony\Component\Form\ReversedTransformer;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;

class JalaliDateChoiceType extends AbstractType {

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
				->add('year', 'choice',
						array(
								'choices' => array_combine($options['years'],
										$options['years']),
								'empty_value' => 'سال'))
				->add('month', 'choice',
						array(
								'choices' => array_combine($options['months'],
										$options['months']),
								'empty_value' => 'ماه'))
				->add('day', 'choice',
						array(
								'choices' => array_combine($options['days'],
										$options['days']),
								'empty_value' => 'روز'))
				->addViewTransformer(new DateToJalaliDateTransformer());

		if ('string' === $options['input']) {
			$builder
					->addModelTransformer(
							new ReversedTransformer(
									new DateTimeToStringTransformer(
											$options['model_timezone'],
											$options['model_timezone'],
											'Y-m-d')));
		} elseif ('timestamp' === $options['input']) {
			$builder
					->addModelTransformer(
							new ReversedTransformer(
									new DateTimeToTimestampTransformer(
											$options['model_timezone'],
											$options['model_timezone'])));
		} elseif ('array' === $options['input']) {
			$builder
					->addModelTransformer(
							new ReversedTransformer(
									new DateTimeToArrayTransformer(
											$options['model_timezone'],
											$options['model_timezone'],
											array('year', 'month', 'day'))));
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver) {
		$compound = function (Options $options) {
			return $options['widget'] !== 'single_text';
		};

		$emptyValue = $emptyValueDefault = function (Options $options) {
			return $options['required'] ? null : '';
		};

		$emptyValueNormalizer = function (Options $options, $emptyValue) use (
				$emptyValueDefault) {
			if (is_array($emptyValue)) {
				$default = $emptyValueDefault($options);

				return array_merge(
						array('year' => $default, 'month' => $default,
								'day' => $default), $emptyValue);
			}

			return array('year' => $emptyValue, 'month' => $emptyValue,
					'day' => $emptyValue);
		};

        // BC until Symfony 2.3
        $modelTimezone = function (Options $options) {
            return $options['data_timezone'];
        };

        // BC until Symfony 2.3
        $viewTimezone = function (Options $options) {
            return $options['user_timezone'];
        };

		$resolver
				->setDefaults(
						array(
								'years' => range(
										DateUtil::date('Y',
												strtotime('-5 year'), false),
										DateUtil::date('Y',
												strtotime('+5 year'), false)),
								'months' => range(01, 12),
								'days' => range(01, 31),
								'widget' => 'choice',
								'input' => 'datetime',
								'model_timezone' => $modelTimezone,
								'view_timezone' => $viewTimezone,
								// Deprecated timezone options
								'data_timezone' => null,
								'user_timezone' => null,
								'empty_value' => $emptyValue,
								// Don't modify \DateTime classes by reference, we treat
								// them like immutable value objects
								'by_reference' => false,
								'error_bubbling' => false,
								// If initialized with a \DateTime object, FormType initializes
								// this option to "\DateTime". Since the internal, normalized
								// representation is not \DateTime, but an array, we need to unset
								// this option.
								'data_class' => null,
								'compound' => $compound,));

		$resolver
				->setNormalizers(
						array('empty_value' => $emptyValueNormalizer,));

		$resolver
				->setAllowedValues(
						array(
								'input' => array('datetime', 'string',
										'timestamp', 'array',),));

	}

	/**
	 * {@inheritdoc}
	 */
	public function getParent() {
		return 'form';
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName() {
		return 'jalali_date_choice';
	}

}
