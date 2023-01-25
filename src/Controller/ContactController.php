<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Event\AccountChangeNotifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    private $em; 

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }
    #[Route('/interventions', name: 'app_contact')]
    public function index(EventDispatcherInterface $dispatcher,Request $request): Response
    {
        // $dispatcher->dispatch(AccountChangeNotifier::class);
        $intervention = new Contact();

        $form = $this->createForm(ContactType::class, $intervention);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $data = $this->em->getRepository(Contact::class)->save($intervention, true);
            
            
        }
        
        return $this->render('contact/index.html.twig', [
            'form' =>$form
        ]);
    }
}
