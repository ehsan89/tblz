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

namespace Factory\UtilityBundle\Form\Type;

use Sonata\AdminBundle\Form\Type\ModelTypeList;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

/**
 * This type is used to render an hidden input text and 3 links
 *   - an add form modal
 *   - a list modal to select the targetted entities
 *   - a clear selection link
 */
class ImageTypeList extends ModelTypeList
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'sonata_type_image_list';
    }
}
