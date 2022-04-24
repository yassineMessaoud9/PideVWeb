<?php

namespace App\Form;

use App\Entity\Reservationhotels;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class ReservationhotelsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typechambre')
            ->add('nbrnuit')
            ->add('datereservation')
            ->add('nbrpersonne')
            ->add('dateallerreser')
            ->add('dateretourreser')
            ->add('idu')
            ->add('idhotel')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservationhotels::class,
        ]);
    }
}
