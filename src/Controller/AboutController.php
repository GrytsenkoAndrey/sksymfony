<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class AboutController extends AbstractController
{
    /**
     * @route("/about", name="app_about")
     */
    public function index()
    {
        return $this->render('about.html.twig', [
            'year' => date('Y')
        ]);
    }
}