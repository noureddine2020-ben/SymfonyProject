<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
              ->add('firstName',TextType::class,[
                 'attr'=> [
                      "placeholder"=>'Tapez votre prénom'
                  ],
                  'label'=> "Prénom",
              ])
              ->add('lastName',TextType::class,[
                'attr'=> [

                      'placeholder'=>'Tapez votre nom'
              ],
                      'label'=>"Nom"
                  ])
              ->add('phoneNumber',TextType::class,[
                  'attr'=> [

                      'placeholder'=>'Tapez votre numéro de téléphone'
                  ],
                  'label'=>"Numéro de téléphone"
              ])
              ->add('email',EmailType::class,[
                  'attr'=> [

                      'placeholder'=>'Tapez votre @mail'
                  ],
                  'label'=>"Adresse mail"
              ])
              ->add('message',TextareaType::class,[
                  'attr'=> [

                      'placeholder'=>'Tapez votre message'
                  ],
                  'label'=>"Message"
              ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
