<?php

namespace App\Form;

use App\Entity\Bac;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Validator\Constraints\StartsWithCapital;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class BacType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ref', TextType::class, [
                'constraints' => [
                    new StartsWithCapital(),
                    new Regex([
                        'pattern' => '/\d/',
                        'message' => 'The referance must contain at least one number.',
                    ]),
                ],
            ])
            ->add('adresse')
            ->add('codepostal', IntegerType::class, [
                'label' => 'Postal Code',
                'required' => true,
                'attr' => [
                    'pattern' => '^[0-9]{5}$',
                    'title' => 'Please enter a valid 5-digit postal code',
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[0-9]{4}$/',
                        'message' => 'Please enter a valid 4-digit postal code',
                    ]),
                ],
            ])
            ->add('capacite', IntegerType::class, [
                'label' => 'capacite',
                'required' => true,
                'attr' => [
                    'min' => 1,
                ],
                'constraints' => [
                    
                    new GreaterThan([
                        'value' => 0,
                        'message' => 'capacite must be greater than zero',
                    ]),
                ],
            ])
            ->add('etat')
            ->add('save',SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bac::class,
        ]);
    }
}
