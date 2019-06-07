<?php

namespace App\Controller;

use App\Entity\Page;
use App\Form\TestFormType;
use App\Services\TestService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/delete-page/{id}", name="deletePage")
     */
    public function deletePage(Page $page, EntityManagerInterface $manager)
    {
        $manager->remove($page);
        $manager->flush();

        return new Response('<html><head><title>Add-page</title></head><body>Обьект удален!</body></html>');
    }

    /**
     * @Route("/index-page", name="indexPage")
     */
    public function indexPage(EntityManagerInterface $manager)
    {
        $pages = $manager->getRepository(Page::class)->findBy(['id' => 5]);
        dd($pages);
    }

    /**
     * @Route("/test-twig", name="testTwig")
     */
    public function testTwig()
    {
        $pages = [
            ['title' => 'Заголовок страницы1', 'content' => 'Контент страницы1'],
            ['title' => 'Заголовок страницы2', 'content' => 'Контент страницы2'],
            ['title' => 'Заголовок страницы3', 'content' => 'Контент страницы3']
        ];

        $today = new \DateTime();
        $temperature = 30;
        $tmp = 15.12321;

        return $this->render('test/test..html.twig', [
            'pages' => $pages,
            'temp' => $temperature,
            'tmp' => $tmp,
            'today' => $today
        ]);
    }

    /**
     * @Route("/form", name="testForm")
     */
    public function testForm(Request $request)
    {
        $form = $this->createForm(TestFormType::class);

        $form->handleRequest($request);

        $data = $form->getData();

        dump($data);


        return $this->render('test/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
