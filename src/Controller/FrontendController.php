<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontendController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('frontend/index.html.twig', [
            'controller_name' => 'homepage',
        ]);
    }

    /**
     * @Route("/frontend", name="edit_profile")
     */
    public function edit()
    {
        return $this->render('frontend/index.html.twig', [
            'controller_name' => 'edit',
        ]);
    }
}
