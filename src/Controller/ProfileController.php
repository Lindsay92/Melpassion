<?php

namespace App\Controller;

use App\Form\UserProfileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfileController extends AbstractController
{
    #[Route('/admin/profile', name: 'profile')]
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $user = $this->getUser();
        $profileForm = $this->createForm(UserProfileType::class, $user);
        $profileForm->handleRequest($request);

        if($profileForm->isSubmitted() && $profileForm->isValid())
        {
            $plainPassword =$profileForm->getData()->getPlainPassword();

            if(!is_null($plainPassword))
            {
            $encodedPassword = $userPasswordHasherInterface->hashPassword($user, $plainPassword);
            $user->setPassword($encodedPassword);
            $this->addFlash('warning', 'Votre mot de passe a bien changé');
            }
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            
            $this->addFlash('success', "Vos informations ont bien été mises à jour");

            return $this->redirectToRoute("profile");
        }


        return $this->render('profile/index.html.twig', [
            // 'controller_name' => 'ProfileController',
            "form"=>$profileForm->createView(),
        ]);
    }
}
