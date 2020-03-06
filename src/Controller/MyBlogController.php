<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MyBlogController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        $name="Yannis";
        return $this->render('my_blog/index.html.twig', [
            'controller_name' => 'MyBlogController',
            'name' => $name
        ]);
    }
}
