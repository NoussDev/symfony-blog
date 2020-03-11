<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MyBlogController extends AbstractController
{
    /**
     * @Route("/{action}",defaults={"action"=""}, name="home")
     */
    public function index($action)
    {
        switch($action){
            case "add_form":
        }
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $categories = $this->getDoctrine()->getRepository(Category::class);

        $categories = $categories->findAll();
        $articles = $repository->findAll();

        return $this->render('my_blog/home.html.twig',[
            'action'=>$action,
            'articles' => $articles,
            'categories' => $categories
        ]);
    }


    /**
     * @Route("/search/{id}", name="category")
     */
    public function searchCategory($id)
    {
       
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $categories = $this->getDoctrine()->getRepository(Category::class);

        if(isset($id)){
            $articles = $repository->findBy(['category' => $id]);

        }else{
            $articles = $repository->findAll();
        }
        $categories = $categories->findAll();

        return $this->render('my_blog/home.html.twig',[
            'articles' => $articles,
            'categories' => $categories
        ]);
    }
}
