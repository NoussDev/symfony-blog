<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MyBlogController extends AbstractController
{
    /**
     * @Route("/{action}",defaults={"action"=""}, name="home")
     */
    public function index($action)
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);

        switch($action){
            case "add_form":
        }

        return $this->render('my_blog/home.html.twig',[
            'action'=>$action,
            'articles' => $repository->findAll()
        ]);
    }
}
