<?php

namespace App\Controller;

use App\Entity\Page;
use App\Services\TestService;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index(TestService $service)
    {
        $tmp = $service->convert(1000);

        return $this->render('main/index.html.twig', [
            'key' => $tmp
        ]);
    }

    /**
     * @Route("/add-page", name="addPage")
     */
    public function addPage(EntityManagerInterface $manager)
    {
        $page = new Page();
        $page->setContent('Это контент или содержимое 2');
        $page->setTitle('Это заголовок 2');
        $page->setPublish(true);

        $manager->persist($page);
        $manager->flush();

        return new Response('<html><head><title>Add-page</title></head><body>Обьект добавлен!</body></html>');
    }

    /**
     * @Route("/show-page/{id}", name="showPage")
     */
    public function showPage(Page $page)
    {
        return $this->render('main/page.html.twig', [
            'page' => $page
        ]);
    }

    /**
     * @Route("/edit-page/{id}", name="editPage")
     */
    public function editPage(Page $page, EntityManagerInterface $manager)
    {
        $page->setTitle('Обновленный заголовок!');
        $page->setPublish(false);

        $manager->flush();

        return new Response('<html><head><title>Add-page</title></head><body>Обьект обновлен!</body></html>');
    }
}
