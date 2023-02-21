<?php

namespace App\Form;

use App\Entity\Bac;
use App\Entity\Categorie;
use App\Entity\Dechet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;


class DechetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantite')
            ->add('date')
            ->add('idCat', EntityType::class, [
                'class'=> Categorie::class,
                'choice_label' => 'id',
                'attr' => [
                    'class' => 'form-control',
                    
                ]
            ])
            ->add('idBac', EntityType::class, [
                'class'=> Bac::class,
                'choice_label' => 'id',
                'attr' => [
                    'class' => 'form-control',
                    
                ]
            ])

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
            'data_class' => Dechet::class,
        ]);
    }
}
