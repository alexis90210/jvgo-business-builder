<?php

namespace App\Controller;

use App\Entity\Demandes;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DashboardController extends AbstractController
{
 
    #[Route('/dashboard', name: 'app_dashboard')]
    public function test(ManagerRegistry $doctrine, Request $request, AuthenticationUtils $auth): Response
    {
        $orm = $doctrine->getManager();

        $session = $request->getSession();

        $authed = $session->get('auth');

        // if ( $authed != 1) {
        //     return $this->redirect("/login");
        // }

        $demandes_entreprise = $orm->getRepository(Demandes::class)->findBy(
            [
                "EntrepriseOrCompta" => 1 // Entreprise
            ]
        );

        $demandes_compta = $orm->getRepository(Demandes::class)->findBy(
            [
                "EntrepriseOrCompta" => 2 // Comptabilite
            ]
        );

        return $this->render('dashboard/dashboard.html.twig', [
            'entreprise' => array_reverse($demandes_entreprise),
            'comptabilite' => array_reverse($demandes_compta),
            'count_entreprise' => count($demandes_entreprise),
            'count_comptabilite' => count($demandes_compta),
            'user' => $auth->getLastUsername()
        ]);
    }

    #[Route('/dashboard/consultion-demandes-{id}', name: 'app_demandes_view')]
    public function index( int $id, ManagerRegistry $doctrine, Request $request, AuthenticationUtils $auth): Response
    {

        $orm = $doctrine->getManager();

        if ( !$id) die('Access refused');

            $demandes= $orm->getRepository(Demandes::class)->findBy(
                [
                    "id" => $id
                ]
            );

        if ( count($demandes) != 1) die('Access refused');
      
        // dd($demandes);
        
         return $this->render('dashboard/demandes.html.twig', [
            'demandes' => $demandes[0],
            'user' => $auth->getLastUsername()
        ]);


    }

    #[Route('/dashboard/demandes-type-{type}', name: 'app_demandes_all')]
    public function demandes( int $type, ManagerRegistry $doctrine, Request $request, AuthenticationUtils $auth): Response
    {

        $orm = $doctrine->getManager();

        if ( !$type) die('Access refused');

        $demandes = $orm->getRepository(Demandes::class)->findBy(
            [
                "EntrepriseOrCompta" => $type // Entreprise
            ]
        );

        $demandes = $orm->getRepository(Demandes::class)->findBy(
            [
                "EntrepriseOrCompta" => $type // Comptabilite
            ]
        );
     
        // dd($demandes);
        
         return $this->render('dashboard/liste.html.twig', [
            'demandes' => array_reverse($demandes),
            'type' => $type,
            'user' => $auth->getLastUsername()
        ]);


    }
    #[Route('/reponse-client', name: 'app_reponse_jvgo', methods: ["POST"])]
    public function reponse_client(Request $request, ManagerRegistry $doctrine, MailerInterface $mailer): Response
    {
        $data = json_decode($request->getContent(), false);

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
