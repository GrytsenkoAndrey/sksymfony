<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ArticleController extends AbstractController
{
    /**
     * @route("/articles", name="app_articles")
     */
    public function index(EntityManagerInterface $em): Response
    {
        if ($this->getParameter('docker.example_enabled')) {
            dd($this->getParameter('docker.docker_prefix'));
        }

        $repository = $em->getRepository(Article::class);
        $articles = $repository->findAll();

        return $this->render('article.html.twig', [
            'year' => date('Y'),
            'likes' => 13,
            'articles' => $articles
        ]);
    }

    /**
     * @route("/articles/{slug}", name="app_article_show")
     */
    public function show(string $slug, EntityManagerInterface $em): Response
    {
        $repository = $em->getRepository(Article::class);
        $article = $repository->findOneBy(['slug' => $slug]);

        if (! $article) {
            throw $this->createNotFoundException(sprintf('Article with slug %s not found', $slug));
        }

        $comments = [
            'Tabes risk tanquam noster pars',
            'Nunquam skdoc datalae',
            'Sunt acipensa annela audax, mobisil',
        ];

        return $this->render('show.html.twig', [
            'article' => $article->getTitle(),
            'articleContent' => $article->getBody(),
            'comments' => $comments,
            'year' => date('Y')
        ]);
    }
}
