<?php

namespace App\Form;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints as Assert;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $villes = [
            'Ariana',
            'Beja',
            'Ben Arous',
            'Bizerte',
            'Gabes',
            'Gafsa',
            'Jendouba',
            'Kairouan',
            'Kasserine',
            'Kebili',
            'La Manouba',
            'Le Kef',
            'Mahdia',
            'Medenine',
            'Monastir',
            'Nabeul',
            'Sfax',
            'Sidi Bouzid',
            'Siliana',
            'Sousse',
            'Tataouine',
            'Tozeur',
            'Tunis',
            'Zaghouan',
        ];
    
        $builder
        ->add('Nom', TextType::class, [
            'constraints' => [
                new NotBlank([
                    'message' => 'Le champ nom est obligatoire'
                ]),
                new Assert\Length([
                    'max' => 12,
                    'maxMessage' => 'Le nom ne doit pas dépasser  12 caractères.'
                ]),
                new Assert\Length([
                    'min' => 4,
                    'maxMessage' => 'Le nom ne doit pas etre inferieur à 4  caractères.'
                ])
            ]])
            ->add('description', TextType::class , [
                'constraints' => [
                    new NotBlank([
                        'message' => ' Le champ description est obligatoire '
                    ])
                ]
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Image (JPG or PNG file)',
              
                'required' => false])
            ->add('type', TextType::class, [
                'label' => 'Type',
                'required' => true,
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/^[a-zA-Zé\s]*$/',
                        'message' => 'Le nom ne doit contenir que des lettres.'
                    ])
                ]
            ])
            ->add('date', DateType::class, [
                'constraints' => [
                    new GreaterThanOrEqual([
                        'value' => 'today',
                        'message' => 'La date  doit être aujourd\'hui ou dans le futur'
                    ])
                ]
            ])
            ->add('Adresse', ChoiceType::class, [
                'choices' => array_combine($villes, $villes),
                'label' => 'Ville',
                'required' => true,
                'placeholder' => 'Choisir une ville',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('Prix')
            ->add('NombrePlace')
            ->add('Save',SubmitType::Class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
