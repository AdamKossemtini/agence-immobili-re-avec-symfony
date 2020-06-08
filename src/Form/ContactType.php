<?php

namespace App\Form;
use App\Entity\Contact;
use App\Entity\Option;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\PropertySearch;
use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname',TextType::class)
            ->add('lastname',TextType::class)
            ->add('email',EmailType::class)
            ->add('phone',TextType::class)
            ->add('message',TextareaType::class)

           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class

        ]);
    }
  
}
