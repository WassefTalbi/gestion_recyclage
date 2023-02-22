<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('date',DateTimeType::class, [
                'data' => new \DateTime(),
            ])
            ->add('urlImg', FileType::class, array('data_class' => null))
            
           ->add('active')
            ->add('idUser',EntityType::class,['class'=> User::class,
           'choice_label'=>'nomUser',
           'label'=>'idUser'])
           
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
