<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('name', TextType::class, [
                "label"=>"Nom"])
            ->add('firstname', TextType::class, [
                "label"=>"Prénom"])
            ->add('pseudo')
            ->add('plainPassword', PasswordType::class, ["label"=>"Changez votre mot de passe", "required"=>false])//changer mon mot de passe
            ->add('confirmPassword', PasswordType::class, ["label"=>"Confirmez votre mot de passe", "required"=>false])
            ->add('Modifier', SubmitType::class, [ 'attr'=>["class" =>"btn-success mt-3"]])
            
            ->remove('roles')
            ->remove('password')
            ->remove('isVerified')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
