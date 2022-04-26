<?php

namespace App\Form;

use App\Entity\Locationvoiture;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder







            ->add('datedebutlocation')




            ->add('datefinlocation')



            
            ->add('datelocation',DateType::class,[
                'constraints'=>[
                    new GreaterThan(
                        [
                            'propertyPath'=>'parent.all[datedebutlocation].data'
                        ]
                    )
                ]
            ])
            // ->add('montant',NumberType::class,array('label'=>'montant' ))
            ->add('idSaison')
            ->add('idu')
            ->add('id_voiture')
        ;
    }
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Locationvoiture::class,
        ]);
    }
}
