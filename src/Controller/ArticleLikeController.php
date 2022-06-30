<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
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
    public function like(Article $article, $type, LoggerInterface $logger, EntityManagerInterface $em): JsonResponse
    {
        if ($type === 'like') {
            $article->like();
            $logger->info('Someone likes article');
        } else {
            $article->dislike();
            $logger->info('Someone dislikes article');
        }
        $em->flush();

        return $this->json(['likes' => $article->getLikeCount()]);
    }
}
