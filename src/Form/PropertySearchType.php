<?php

namespace App\Form;
use App\Entity\Option;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\PropertySearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {//cette fonction pour construire le formulaire de recherche (surface min et maxprice avec les options que l'utilisateur veux)

        $builder
            ->add('minSurface',IntegerType::class,[
                'required'=>false,
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Surface minimale'
                ]

            ])
            ->add('maxPrice',IntegerType::class,[
                'required'=>false,
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Budget max'
                ]

            ])
          
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            'method'=>'get',
            'csrf_protection'=>false

        ]);
    }
    public function getBlockPrefix(){
        return '';
    }
}
