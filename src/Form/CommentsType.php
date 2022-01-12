<?php

namespace App\Form;

use App\Entity\Comments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class CommentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                "label"=>"Votre nom", 
                "attr" => ["class"=>"form-control"]])
            ->add('content', TextType::class, [
                "label"=>"Votre commentaire", 
                "attr" => ["class"=>"form-control"]])
            ->add('rgpd', CheckboxType::class, [
                "label"=>"Vous acceptez notre politique de confidentialité",
                'constraints' => [new NotBlank()]])
            ->add('parentId', HiddenType::class, [
                'mapped' => "false",  //=> il n'est pas stocké en bdd
                // 'empty_data' => '',
                ])           
            ->add('envoyer', SubmitType::class)

            ->remove('active')
            
            ->remove('createdAt')
            
            ->remove('blog')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comments::class,
        ]);
    }
}
