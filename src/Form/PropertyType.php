<?php

namespace App\Form;

use App\Entity\Option;
use App\Entity\Proprity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('name')
            ->add('price')
            ->add('location')
            ->add('solde')
            ->add('date_mise_circul')
            ->add('marque')
            ->add('puissance')
            ->add('tranmission')
            ->add('compteur')
            ->add('options',EntityType::class,[
                'required'=>false,
                'class'=> Option::class,
                'choice_label'=>'name',
                'multiple'=>true,
            ])
            ->add('imageFile',FileType::class,[
                    'required'=>false

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Proprity::class,
        ]);
    }
}
