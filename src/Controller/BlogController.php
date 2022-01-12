<?php

namespace App\Controller;

use DateTimeImmutable;
use App\Entity\Comments;
use App\Form\CommentsType;
use App\Repository\BlogRepository;
use App\Repository\CommentsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog')]
    public function index(BlogRepository $blogRepository): Response
    {
        return $this->render('blog/index.html.twig', [
            'blogContent' => $blogRepository -> findAll(),
        ]);
    }

    #[Route('/blog/{slug}', name:'blog-detail')]

    public function detail(BlogRepository $blogRepository, int $slug, Request $request): Response 
    {
        $blog = $blogRepository -> find($slug);

        $comments = new Comments();
        $commentsForm = $this ->createForm(CommentsType::class, $comments);
        $commentsForm->handleRequest($request);

        if($commentsForm->isSubmitted()&& $commentsForm->isValid())//tjs ds cette ordre
        {
            $comments->setCreatedAt(new DateTimeImmutable());
            $comments->setblog($blog);

            $parentId = $commentsForm->get("parentId")->getData();//parent va attendre une entité comments et pas un nbr donc pas de mappage

            $em = $this->getDoctrine()->getManager();

            if($parentId != null)
            {
                $parent = $em->getRepository(Comments::class)->find($parentId);// soit je récupère un commentaire ou nul
            }
            
            $comments->setParent($parent ?? null);//on définit le parent
    
            $em->persist($comments);
            $em->flush();

            $this->addFlash('success','Votre commentaire a bien été pris en compte');
            return $this->redirectToRoute('blog-detail', ['slug'=>$blog->getId()] );

        }
        
        return $this->render('blog/detail.html.twig', [
            "blog" => $blog,
            "commentsForm" => $commentsForm->createView(),//génère le formulaire ds mon html
        ]);
    }
}
