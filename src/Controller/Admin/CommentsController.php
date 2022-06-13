<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentsController extends AbstractController
{
    /**
    * @route("/admin/comments", name="app_admin_comments")
    */
    public function index(Request $request): Response
    {
        $q = $request->query->get('q');
        if ($q) {
            $q = strip_tags($q);
        }

        $comments = [
            [
                'articleTitle' => 'Is there anything after 9 life?',
                'comment' => 'Comment 1',
                'createdAt' => new \DateTime('-1 hours'),
                'authorName' => 'Funny'
            ],
            [
                'articleTitle' => 'Where is my food?',
                'comment' => 'Comment 2',
                'createdAt' => new \DateTime('-1 days'),
                'authorName' => 'Cat'
            ],
            [
                'articleTitle' => 'What to do if you are boring?',
                'comment' => 'Comment 3',
                'createdAt' => new \DateTime('-3 days'),
                'authorName' => 'Symba'
            ],
        ];

        return $this->render('admin/comments/index.html.twig', [
            'comments' => $comments,
            'q' => $q
        ]);
    }
}
