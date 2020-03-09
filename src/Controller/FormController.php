<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class FormController extends AbstractController
{
    /**
     * @Route("/form/{id}",defaults={"id"=""}, name="form")
     */
    public function index(Request $request, $id)
    {
        $article = new Article();

        $form = $this->createFormBuilder($article)
        ->add('Title', TextType::class)
        ->add('Content',TextareaType::class)
        ->add('Picture',TextType::class)
        ->add('Save',SubmitType::class)
        ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $article = $form->getData();
            $article->setCreatedAt(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('home',['action' => 'add_success']);
        }

        return $this->render('form/form.html.twig', [
            'form' => $form->createView(),
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
