<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InterventionsController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    #[Route('/admin/interventions', name: 'app_interventions')]
    public function index(): Response
    {
        

        $interventions = $this->em->getRepository(Contact::class)->findAll();


        return $this->render('interventions/index.html.twig', [
            'interventions' => $interventions
        ]);
    }
}
