<?php

namespace App\Controller;

use Demontpx\ParsedownBundle\Parsedown;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ArticleController extends AbstractController
{
    /**
     * @route("/articles", name="app_articles")
     */
    public function index(): Response
    {
        $articles = [
            [
                'slug' => 'first-article',
                'content' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).'
            ],
            [
                'slug' => 'second-article',
                'content' => 'Second article for the website. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).'
            ],
        ];

        return $this->render('article.html.twig', [
            'year' => date('Y'),
            'likes' => 13,
            'articles' => $articles
        ]);
    }

    /**
     * @route("/articles/{slug}", name="app_article_show")
     */
    public function show(
        string $slug,
        Parsedown $parsedown,
        AdapterInterface $cache
    ): Response {
        $comments = [
            'Tabes risk tanquam noster pars',
            'Nunquam skdoc datalae',
            'Sunt acipensa annela audax, mobisil',
        ];

        $articles = [
            [
                'slug' => 'first-article',
                'content' => 'It is a **long** established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).'
            ],
            [
                'slug' => 'second-article',
                'content' => '_Second article for the website_. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).'
            ],
        ];
        foreach ($articles as $article) {
            if ($article['slug'] === $slug) {
                $article_content = $parsedown->text($article['content']);

                $item = $cache->get('markdown_' . md5($article_content), function () use ($article_content) {
                    return $article_content;
                });
            }
        }

        return $this->render('show.html.twig', [
            'article' => ucwords(str_replace('-', ' ', $slug)),
            'articleContent' => $item,
            'comments' => $comments,
            'year' => date('Y')
        ]);
    }
}
