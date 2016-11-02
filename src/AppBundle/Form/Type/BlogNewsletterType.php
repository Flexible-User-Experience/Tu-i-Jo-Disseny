<?php

namespace AppBundle\Form\Type;

/**
 * Class ContactNewsletterType
 *
 * @category FormType
 * @package  AppBundle\Form\Type
 * @author   David Romaní <david@flux.cat>
 */
class BlogNewsletterType extends ContactNewsletterType
{
    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'blog_newsletter';
    }
}
