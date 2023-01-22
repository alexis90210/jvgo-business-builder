<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', []);
    }

    #[Route('/sendmail', name: 'app_sendmail')]
    public function sendmail(Request $request,  MailerInterface $mailer): Response
    {
        $data = json_decode($request->getContent(), false);

        $jvgo = $this->getParameter('app.admin_mail');

        if ($data) {

            // TO CLIENT
            $email1 = (new Email())
                ->from($jvgo)
                ->to($data->Email)
                ->priority(Email::PRIORITY_HIGH)
                ->subject("JVGO Confirmation !")
                ->html("Bonjour {$data->Civilite}! <br>
                Vous souhaitez démarrer votre activité ? Déléguer votre compta ? <br>
                Notre équipe est là pour vous conseiller. Vous recevrez une réponse en moins de 24 heures.");

            $mailer->send($email1);

            // TO ADMIN
            $email2 = (new Email())
                ->from( $jvgo )
                ->to( $jvgo )
                ->priority(Email::PRIORITY_HIGH)
                ->subject("JVGO Message de contact entrant !")
                ->html("Bonjour! <br>
                Je suis {$data->Civilite} {$data->Prenom} {$data->Nom} <br>
                Je souhaite {$data->Motif} <br>
                Ci-dessous :  <br>Mon email : {$data->Email} <br>Mon Mobile : {$data->Mobile}");

            $mailer->send($email2);


            return $this->json([
                'code' => 'success',
                'message' => 'Mail transmit'
            ]);
        } else {

            return $this->json([
                'code' => 'error',
                'message' => 'data-raw body vide'
            ]);
        }
    }

}
