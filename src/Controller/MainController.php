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
    public function showPage($id, EntityManagerInterface $manager)
    {
        // dd($id);
        $repository = $manager->getRepository(Page::class);

        $page = $repository->findOneBy(['id' => $id]);

        if (!$page) {
            throw $this->createNotFoundException('Такой страницы не найдено с id = "%s"' . $id);
        }

        dd($page);
    }
}
