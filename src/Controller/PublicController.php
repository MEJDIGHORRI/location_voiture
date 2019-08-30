<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublicController extends AbstractController
{


    /**
     * @Route("/", name="app_index", methods={"GET"})
    */
    public function index()
    {
        return $this->render('post/index.html.twig');
    }
}
