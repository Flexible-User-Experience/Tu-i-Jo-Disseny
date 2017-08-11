<?php

namespace AppBundle\Form\Type;

use Beelab\Recaptcha2Bundle\Form\Type\RecaptchaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Class ContactNewsletterType
 *
 * @category FormType
 * @package  AppBundle\Form\Type
 * @author   David Romaní <david@flux.cat>
 */
class ContactNewsletterType extends AbstractType
{
    /**
     * @var string
     */
    protected $recaptchaSiteKey;

    /**
     * Methods
     */

    /**
     * @param string $recaptchaSiteKey
     */
    public function __construct($recaptchaSiteKey) {
        $this->recaptchaSiteKey = $recaptchaSiteKey;
    }

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
                        'placeholder' => 'form.label.email',
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
//                        'data-sitekey' => $this->recaptchaSiteKey,
//                        'data-callback' => 'onSubmitContactNewsletter',
//                        'data-size' => 'invisible',
                    ),
                )
            )
            ->add(
                'captcha',
                RecaptchaType::class,
                array(
                    'mapped' => true,
                )
            )
        ;
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'contact_newsletter';
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
                'attr'            => array(
                    'class' => 'form-inline m-bottom',
                ),
            )
        );
    }
}
