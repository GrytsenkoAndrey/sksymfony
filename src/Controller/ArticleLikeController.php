<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
#use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class ArticleLikeController extends AbstractController
{
    /**
     * @param $id
     * @param $type
     * @route("/articles/{id<\d+>}/like/{type<like|dislike>}", methods={"POST"}, name="app_articles_like")
     */
    public function like($id, $type)
    {
        if ($type === 'like') {
            $likes = random_int(13, 130);
        } else {
            $likes = random_int(0, 12);
        }

        #return new JsonResponse(['likes' => $likes]);
        return $this->json(['likes' => $likes]);
    }
}
