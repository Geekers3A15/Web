<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
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
            ->add('categorie')
            ->add('description')
            ->add('dateDeb')
            ->add('dateFin')
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
