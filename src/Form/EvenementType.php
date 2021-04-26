<?php

namespace App\Form;

use App\Entity\Evenement;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titreEvent')

            ->add('imageEvent',FileType::class,[
                'mapped'=>false,
                'required'=>false,
            ])
            ->add('categorie',ChoiceType::class,[
                'choices'=>[
                    'Photography' => 'Photography',
                    'Design' => 'Design',
                    'Music' => 'Music',
                    ]
            ])

            ->add('description')
            ->add('dateDeb',DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                "data" => new \DateTime(),


            ])
            ->add('dateFin',DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                "data" => new \DateTime(),

            ])
            ->add('location')
            ->add('nbMax')
            ->add('prix')


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
