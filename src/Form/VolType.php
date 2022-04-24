<?php

namespace App\Form;

use App\Entity\Vol;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\GreaterThan;

class VolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateallervol')
            ->add('tempallervol')
            ->add('dateretourvol',DateType::class,[
                'constraints'=>[
                    new GreaterThan(
                        [
                            'propertyPath'=>'parent.all[dateallervol].data'
                        ]
                    )
                ]
            ])
            ->add('tempretourvol')
            ->add('destination')
            ->add('classvol')
            ->add('prixvol')
            ->add('typevol')
            ->add('idcompagnie')
            ->add('numserieavion')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vol::class,
        ]);
    }
}
