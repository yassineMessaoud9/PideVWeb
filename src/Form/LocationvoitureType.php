<?php

namespace App\Form;

use App\Entity\Locationvoiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationvoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datedebutlocation')
            ->add('datefinlocation')
            ->add('datelocation')
            ->add('montant')
            ->add('idSaison')
            ->add('idu')
            ->add('matricule')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Locationvoiture::class,
        ]);
    }
}
