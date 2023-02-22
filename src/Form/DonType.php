<?php

namespace App\Form;

use App\Entity\Don;
use App\Entity\User;
use App\Entity\Charite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeDons')
            ->add('descriptionDons')
            ->add('idUser',EntityType::class,['class'=> User::class,
            'choice_label'=>'idUser',
            'label'=>'idUser'])
            ->add('idCharite',EntityType::class,['class'=> Charite::class,
           'choice_label'=>'nomCharite',
           'label'=>'nomCharite']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Don::class,
        ]);
    }
}
