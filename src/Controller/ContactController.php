<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Classes\Htmlbuilder;
use Symfony\Component\Mime\Email;
use App\Event\AccountChangeNotifier;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    private $em; 
    public const EMAIL = 'fred.gruwe@gmail.com';

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }
    #[Route('/interventions/{type}', name: 'app_contact',  defaults :["type" => "type de la demande"])]
    public function index(EventDispatcherInterface $dispatcher,Request $request, $type): Response
    {
        // $dispatcher->dispatch(AccountChangeNotifier::class);
        $intervention = new Contact();
        $intervention->setTitle($type);

        $form = $this->createForm(ContactType::class, $intervention);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $data = $this->em->getRepository(Contact::class)->save($intervention, true);
            $clientEmail = $form->get('email')->getData();
            $clientIntervention = $form->get('title')->getData();
            $clientDescription = $form->get('description')->getData();
            $name = $form->get('name')->getData();
            $telephone = $form->get('telephone')->getData();

            // $transport = Transport::fromDsn("mailjet+smtp://c5603f569b610f8709f5010192785c92:6335608f8a81b411d6dec768c483005f@in-v3.mailjet.com");
            $transport = Transport::fromDsn('smtp://75cf0bf000e485:41713f82297398@smtp.mailtrap.io:2525');
            // $transport = Transport::fromDsn('sendgrid+smtp://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@default');
            $mailer = new Mailer($transport);

            $email = (new Email())
                ->from($clientEmail)
                ->to(self::EMAIL)
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Time for Symfony Mailer!')
                ->text('Sending emails is fun again!')
                ->html(Htmlbuilder::render($clientIntervention, $name, $clientDescription, $clientEmail, $telephone));

            $mailer->send($email);

            $this->addFlash('intervention', 'demande d\'intervention envoyée !');

            $this->redirect('app_home');
        }
        
        return $this->render('contact/index.html.twig', [
            'form' => $form,
        ]);
    }
}
