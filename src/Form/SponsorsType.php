<?php

namespace App\Form;

use App\Entity\Sponsors;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;

class SponsorsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomsponsors')
            ->add('prixdonations')
            ->add('datedeb')
            ->add('datefin',DateType::class,[
                'constraints'=>[
                    new GreaterThan(
                        [
                            'propertyPath'=>'parent.all[datedeb].data'
                        ]
                    )
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sponsors::class,
            'attr'=>['novalidate'=>'novalidate']

        ]);
    }
}
