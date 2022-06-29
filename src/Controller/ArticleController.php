<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ArticleController extends AbstractController
{
    /**
     * @route("/articles", name="app_articles")
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findLatestPublished();

        return $this->render('article.html.twig', [
            'year' => date('Y'),
            'likes' => 13,
            'articles' => $articles
        ]);
    }

    /**
     * @route("/articles/{slug}", name="app_article_show")
     */
    public function show(string $slug, ArticleRepository $articleRepository): Response
    {
        $article = $articleRepository->findOneBy(['slug' => $slug]);

        if (! $article) {
            throw $this->createNotFoundException(sprintf('Article with slug %s not found', $slug));
        }

        $comments = [
            'Tabes risk tanquam noster pars',
            'Nunquam skdoc datalae',
            'Sunt acipensa annela audax, mobisil',
        ];

        return $this->render('show.html.twig', [
            'article' => $article,
            'comments' => $comments,
            'year' => date('Y')
        ]);
    }
}
