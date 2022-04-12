<?php

namespace App\Form;

use App\Entity\Commandrestau;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandrestauType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prixCommande')
            ->add('dateCommande')
            ->add('latitude')
            ->add('longitude')
            ->add('etat')
            ->add('iduser')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commandrestau::class,
        ]);
    }
}
