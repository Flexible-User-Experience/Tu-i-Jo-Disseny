<?php

namespace AppBundle\Form\Type;

use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as RecaptchaTrue;
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
                        'class' => 'btn-default squared bolder',
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
        return 'jiden_blok';
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class'      => 'AppBundle\Entity\ContactMessage',
                'csrf_protection' => true,
            )
        );
    }
}
