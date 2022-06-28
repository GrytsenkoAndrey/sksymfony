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

        $comments = [
            [
                'articleTitle' => 'Is there anything after 9 life?',
                'comment' => 'Comment 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'createdAt' => new \DateTime('-1 hours'),
                'authorName' => 'Funny'
            ],
            [
                'articleTitle' => 'Where is my food?',
                'comment' => 'Value 2. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'createdAt' => new \DateTime('-1 days'),
                'authorName' => 'Cat'
            ],
            [
                'articleTitle' => 'What to do if you are boring?',
                'comment' => 'Comment 3. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'createdAt' => new \DateTime('-3 days'),
                'authorName' => 'Symba'
            ],
        ];

        if ($q) {
            $q = strip_tags($q);
            $comments = array_filter($comments, function ($comment) use ($q) {
                return stripos($comment['comment'], $q) !== false;
            });
        }

        return $this->render('admin/comments/index.html.twig', [
            'comments' => $comments
        ]);
    }
}
