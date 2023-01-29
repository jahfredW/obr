<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrestationsController extends AbstractController
{
    #[Route('/prestations/{type}', name: 'app_prestations', defaults :["type" => "sanitaires"])]
    public function index(): Response
    {
        return $this->render('prestations/index.html.twig');
    }
}
