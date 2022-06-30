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
        $article = new Article();
        $postfix = mt_rand(100, 999);
        $article
            ->setTitle('Article ' . $postfix)
            ->setSlug('article-' . $postfix)
            ->setBody($postfix . ' :: It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).');

        if (rand(1, 10) > 4) {
            $article->setPublishedAt(new \DateTimeImmutable(sprintf('-%d days', rand(0, 30))));
        }

        $article->setAuthor('Best Vasya')
            ->setLikeCount(random_int(1, 100))
            ->setImageFilename('simon-hey.png');

        $entityManager->persist($article);
        $entityManager->flush();

        return new Response(sprintf(
            'Article created with id: %d slug %s',
            $article->getId(),
            $article->getSlug()
        ));
    }
}
