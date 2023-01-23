<?php

namespace App\Controller;

use App\Entity\Demandes;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class DetailDemandeController extends AbstractController
{
    #[Route('/dashboard/detail-demande/{id}', name: 'app_detail_demande')]
    public function index(string $id, ManagerRegistry $doctrine, Request $request): Response
    {
        $orm = $doctrine->getManager();

        $session = $request->getSession();

        $authed = $session->get('auth');

         if ( $authed != 1) {
            return $this->redirect("/login");
        }


        $maDemande = $orm->getRepository(Demandes::class)->find($id);

        if (!$maDemande) $this->redirect('/');

        return $this->render('detail_demande/index.html.twig', [
            'demande' => $maDemande,
        ]);
    }

    // THIS IS CALL FROM AXIOS

    #[Route('/reponse-client', name: 'app_reponse_jvgo', methods: ["POST"])]
    public function reponse_client(Request $request, ManagerRegistry $doctrine, MailerInterface $mailer): Response
    {
        $data = json_decode($request->getContent(), false);

        $session = $request->getSession();

        $authed = $session->get('auth');

         if ( $authed != 1) {
            return $this->redirect("/login");
        }

        if ($data) {

            $orm = $doctrine->getManager();

            $demande = $orm->getRepository(Demandes::class)->find($data->id);

            if (!$demande) return $this->json(['code' => 'error', 'message' => 'id manquant']);

            $demande->setStatus('Repondu');

            $orm->flush();

            $jvgo = $this->getParameter('app.admin_mail');

            try {
                $email = (new Email())
                    ->from($jvgo)
                    ->to($data->email)
                    ->priority(Email::PRIORITY_HIGH)
                    ->subject("JVGO Reponse !")
                    ->html("Bonjour ! <br>{$data->message} ");

                $mailer->send($email);
            } catch (\Throwable $th) {
                $errorOrSuccess =  $th;
            }

            return $this->json([
                'code' => 'success',
                'message' => 'Reponse transmit'
            ]);
        } else {

            return $this->json([
                'code' => 'error',
                'message' => 'data-raw body vide'
            ]);
        }
    }
}
