<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Class ContactMessageType
 *
 * @category FormType
 * @package  AppBundle\Form\Type
 * @author   David Romaní <david@flux.cat>
 */
class ContactMessageType extends AbstractType
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
                'name',
                TextType::class,
                array(
                    'label'    => false,
                    'required' => true,
                    'attr'     => array(
                        'placeholder' => 'form.label.name',
                    ),
                )
            )
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
                'phone',
                TextType::class,
                array(
                    'label'    => false,
                    'required' => false,
                    'attr'     => array(
                        'placeholder' => 'form.label.phone',
                    ),
                )
            )
            ->add(
                'message',
                TextareaType::class,
                array(
                    'label'    => false,
                    'required' => true,
                    'attr'     => array(
                        'rows'        => 5,
                        'placeholder' => 'form.label.message',
                    ),
                )
            )
            ->add(
                'send',
                SubmitType::class,
                array(
                    'label' => 'form.label.send',
                    'attr'  => array(
                        'class' => 'btn-default squared bolder g-recaptcha',
                        'data-sitekey' => $this->recaptchaSiteKey,
                        'data-callback' => 'onSubmitContactMessage',
                        'data-size' => 'invisible',
                    ),
                )
            );
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'contact_message';
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\ContactMessage',
            )
        );
    }
}
