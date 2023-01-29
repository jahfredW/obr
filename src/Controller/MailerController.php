<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
    private $mailer;

    public function __construct(MailerInterface $mailer){
        $this->mailer = $mailer;
    }
    #[Route('/email')]
    public function sendEmail() : Response
    {   
        // $transport = Transport::fromDsn("mailjet+smtp://c5603f569b610f8709f5010192785c92:6335608f8a81b411d6dec768c483005f@in-v3.mailjet.com");
        // $transport = Transport::fromDsn('smtp://75cf0bf000e485:41713f82297398@smtp.mailtrap.io:2525');
        // $transport = Transport::fomDsn('sendgrid+smtp://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@default');
        $this->mailer = new Mailer(Transport::fromDsn($_ENV['MAILER_DSN']));

        $email = (new Email())
            ->from('fred.gruwe@gmail.com')
            ->to('f.gruwe@laposte.net')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $this->mailer->send($email);

        return $this->render('mailer/index.html.twig');
    }
}