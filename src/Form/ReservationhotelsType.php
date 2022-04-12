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
            ->add('datereservation', DateType::class, [
                'label' => 'Date de reservation',
                'widget' => 'single_text',
                'html5' => false,

                'attr' => ['class' => 'js-datepicker'],
            ])
            ->add('nbrpersonne')
            ->add('dateallerreser', DateType::class, [
                'label' => 'Date de debut reservation',
                'widget' => 'single_text',
                'html5' => false,

                'attr' => ['class' => 'js-datepicker'],
            ])
            ->add('dateretourreser', DateType::class, [
                'label' => 'Date de  fin reservation',
                'widget' => 'single_text',
                'html5' => false,

                'attr' => ['class' => 'js-datepicker'],
            ])
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
