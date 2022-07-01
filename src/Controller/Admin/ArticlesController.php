<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    #[Route('/admin/articles', name: 'app_admin_articles')]
    public function index(): Response
    {
        return $this->render('admin/articles/index.html.twig', [
            'controller_name' => 'ArticlesController',
        ]);
    }

    #[Route('/admin/articles/create', name: 'app_admin_articles_create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        return new Response('Here will be page to create an Article');
    }
}
