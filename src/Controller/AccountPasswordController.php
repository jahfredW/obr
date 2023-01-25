<?php

namespace App\Controller;

use App\Form\AccountPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountPasswordController extends AbstractController
{
    private $em;
    private $hasher;

    public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $hasher){
        $this->em = $em;
        $this->hasher = $hasher;

    }
    #[Route('/admin/password', name: 'app_account_password')]
    public function index(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(AccountPasswordType::class, $user);

        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid() ){
            
            $old_password = $form->get('old_password')->getData();

            if($this->hasher->isPasswordValid($user, $old_password)){
                $new_password = $form->get('new_password')->getData();
                $password = $this->hasher->hashPassword($user, $new_password);

                $user->setPassword($password);

                $this->em->persist($user);

                $this->em->flush();

                $this->addFlash('success', 'Mot de passe changé avec succès');
            } else {
                $this->addFlash('failed', 'Attention, le mot de passe ne correspond pas!');
            }
            
        } elseif ( $form->isSubmitted() &&  !$form->isValid()) {
            $this->addFlash('failed', "Le mot de passe n'est pas le bon");
        }

        return $this->render('account_password/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
  