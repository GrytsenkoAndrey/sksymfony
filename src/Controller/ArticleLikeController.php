<?php

namespace App\Controller;

use App\Entity\Article;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class ArticleLikeController extends AbstractController
{
    /**
     * @param $type
     * @route("/public/articles/{slug}/like/{type<like|dislike>}", methods={"POST"}, name="app_articles_like")
     */
    public function like(Article $article, $type, LoggerInterface $logger): JsonResponse
    {
        if ($type === 'like') {
            $likes = random_int(13, 130);
            $logger->info('Someone likes article');
        } else {
            $likes = random_int(0, 12);
            $logger->info('Someone dislikes article');
        }

        return $this->json(['likes' => $likes]);
    }
}
