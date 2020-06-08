<?php

namespace App\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Property;
use App\Entity\Option;
use App\Form\OptionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
class PropertyType extends AbstractType
{    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {//presenter les elements (comme title,description ....) du formulaire 
        $builder
            ->add('title')
            ->add('description')
            ->add('surface')
            ->add('rooms')
            ->add('bedrooms')
            ->add('floor')
            ->add('price')
            ->add('heat', ChoiceType::class,[
             'choices'=>$this->getChoices()
            ])
            ->add('options',EntityType::class,[
                'required'=>false,
                'class'=> Option::class,
                'choice_label'=> 'name',
                'multiple'=>true
            ])
            ->add('imageFile',FileType::class,[
                'required'=>false
            ])
            ->add('city')
            ->add('adress')
            ->add('postalcode')
            ->add('solde')
       
           
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
            'translation_domain'=>'forms'
        ]);
    }

    //cette fonction pour avoir des options pour le 'heat',choisir entre chauffage et electric 
    private function getChoices(){
        $choices=Property::HEAT;
        $outpout=[];
        foreach ($choices as $k => $v) {
         $outpout[$v]=$k;
        }
        return $outpout;
    }
}
