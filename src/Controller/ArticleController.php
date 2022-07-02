<?php

namespace App\Controller;

use App\Entity\Article;
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
    public function show(Article $article): Response
    {
        return $this->render('show.html.twig', [
            'article' => $article,
            'year' => date('Y')
        ]);
    }
}
