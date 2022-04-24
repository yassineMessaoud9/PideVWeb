<?php

namespace App\Form;

use App\Entity\Reservationrestaurant;

use App\Entity\Restaurant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ReservationrestaurantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datereservationrestau')
            ->add('datedebutres')
            ->add('datefinres')
            ->add('idrestau',EntityType::class,['class'=>Restaurant::class,'choice_label'=>'nomrestau'])
            ->add('idu')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservationrestaurant::class,
        ]);
    }
}
