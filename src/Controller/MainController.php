<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index()
    {
        echo '123';
//        return $this->render('main/index.html.twig', [
//            'controller_name' => 'MainController',
//        ]);
    }
}
