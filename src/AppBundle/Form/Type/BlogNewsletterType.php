<?php

namespace AppBundle\Form\Type;

use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as RecaptchaTrue;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'email',
                EmailType::class,
                array(
                    'label'    => false,
                    'required' => true,
                    'attr'     => array(
                        'placeholder' => 'form.label.newsletteremail',
                    ),
                )
            )
            ->add(
                'send',
                SubmitType::class,
                array(
                    'label' => 'form.label.forward',
                    'attr'  => array(
                        'class' => 'btn-default squared no-gap newsletter',
                    ),
                )
            )
            ->add(
                'captcha',
                EWZRecaptchaType::class,
                array(
                    'label' => ' ',
                    'attr' => array(
                        'options' => array(
                            'theme' => 'light',
                            'type'  => 'image',
                            'size'  => 'normal',
                        )
                    ),
                    'mapped' => false,
                    'constraints' => array(
                        new RecaptchaTrue(),
                    ),
                )
            )
        ;
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'blog_newsletter';
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class'      => 'AppBundle\Entity\ContactNewsletter',
                'csrf_protection' => true,
            )
        );
    }
}
