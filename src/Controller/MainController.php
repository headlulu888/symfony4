<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index(LoggerInterface $logger)
    {
        $tmp = 'Test123';

        $logger->info('Проба лог');

        return $this->render('main/index.html.twig', [
            'key' => $tmp
        ]);
    }
}
