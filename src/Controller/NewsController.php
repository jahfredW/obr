<?php

namespace App\Controller;

use App\Entity\News;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }
    #[Route('/articles', name: 'app_news')]
    public function index(): Response
    {
        $articles = $this->em->getRepository(News::class)->findAll();

        return $this->render('news/index.html.twig', [
            'articles' => $articles
        ]);
    }
}
