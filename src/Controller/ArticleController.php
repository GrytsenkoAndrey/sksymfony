<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class ArticleController extends AbstractController
{
    /**
     * @route("/articles", name="app_articles")
     */
    public function index()
    {
        return $this->render('article.html.twig', [
            'year' => date('Y'),
            'likes' => 13
        ]);
    }
}
