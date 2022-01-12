<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                "label"=>"Votre nom", 
                "attr" => ["class"=>"form-control"]])
            ->add('firstname', TextType::class, [
                "label"=>"Votre prénom", 
                "attr" => ["class"=>"form-control"]])
            ->add('phone', TextType::class, [
                "label"=>"Votre téléphone", 
                "attr" => ["class"=>"form-control"]])
            ->add('email', EmailType::class,[
                "label"=>"Votre email", 
                "attr" => ["class"=>"form-control"]])
            ->add('message', TextType::class, [
                "label"=>"Votre message", 
                "attr" => ["class"=>"form-control"]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
