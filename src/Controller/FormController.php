<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class FormController extends AbstractController
{
    /**
     * @Route("/form/new",name="form_new")
     * @Route("/form/{id}/edit", name="form_edit")
     */
    public function index(Request $request, Article $article = null)
    {
        $categories = $this->getDoctrine()->getRepository(Category::class);

        if(!$article){
            $article = new Article();
        }

        $form = $this->createFormBuilder($article)
        ->add('title', TextType::class)
        ->add('category',EntityType::class, [
            'class' => Category::class,
            'choice_label' => 'title'
        ])
        ->add('content',TextareaType::class)
        ->add('picture',TextType::class)
        ->add('save',SubmitType::class,[
            'attr' => [
                'class' => 'btn waves-effect waves-light'
            ]
        ])
        ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $article = $form->getData();
            if(!$article->getId())
            {
                $article->setCreatedAt(new \DateTime());                
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('home',['action' => 'add_success']);
        }

        return $this->render('form/form.html.twig', [
            'form' => $form->createView(),
            'categories' => $categories->findAll()
        ]);
    }

    /**
     * @Route("/form/delete/{id}", name="delete_article")
     */
    public function deleteArticle(Request $request, $id){
       $entityManager = $this->getDoctrine()->getmanager();
       $article = $entityManager->getRepository(Article::class)->find($id);
       $entityManager->remove($article);
       $entityManager->flush();

       return $this->redirectToRoute('home',['action' => 'remove_success']);
    }
}
