<?php

namespace App\Form;

use App\Entity\Ticket;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $types = [
            'Adulte',
            'Enfant',
            'Etudiant',
            
        ];
        $builder
           
        ->add('Quantite', IntegerType::class, [
            'constraints' => [
                new Positive([
                    'message' => 'La quantité doit être un entier positif'
                ]),
                new LessThanOrEqual([
                    'value' => 10,
                    'message' => 'La quantité ne doit pas dépasser 10'
                ])
            ]
        ])
            ->add('Type', ChoiceType::class, [
                'choices' => array_combine($types, $types),
                'label' => 'Type',
                'required' => true,
                'placeholder' => 'Choisir un type',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('Ticket',EntityType::class, [
                'class' => User::class,
                 'choice_label' => 'Name',
                  'expanded' => false ,
                   'multiple' => false ])
            ->add('Save',SubmitType::Class)
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
        ]);
    }
}
