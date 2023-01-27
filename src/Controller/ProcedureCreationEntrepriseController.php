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

class ProcedureCreationEntrepriseController extends AbstractController
{
    #[Route('/procedure-creation-entreprise/{slug}', name: 'app_procedure_creation_entreprise')]
    public function index(string $slug): Response
    {
        return $this->render('procedure_creation_entreprise/index.html.twig', [
            'TypeEntreprise' => "{$slug}",
        ]);
    }

    // THIS IS CALL FROM AXIOS

    #[Route('/save/creation-entreprise', name: 'app_save_creation_entreprise', methods: ["POST"])]
    public function api(Request $request, ManagerRegistry $doctrine , MailerInterface $mailer): Response
    {
        $data = json_decode($request->getContent(), false);

        if ($data) {

            $orm = $doctrine->getManager();

            $demande = new Demandes();

            $DateCreation = date('Y-m-d');

            $demande->setNom($data->Nom);
            $demande->setPrenom($data->Prenom);
            $demande->setCivilite($data->Civilite);
            $demande->setEmail($data->Email);
            $demande->setStructure("Societé");
            $demande->setNomStructure($data->NomEntreprise);
            $demande->setDateCreation($DateCreation);
            $demande->setDelaiCreation($data->Delai);
            $demande->setFormule("");
            $demande->setMontant("");
            $demande->setTypeEntreprise($data->TypeEntreprise);
            $demande->setTypeAbonnement("");
            $demande->setEntrepriseOrCompta(1); // Pour la creation entreprise
            $demande->setStatus("Non repondu");
            $demande->setMobile( $data->Mobile);

            $orm->persist($demande);

            $orm->flush();

            $errorOrSuccess = "";
            $jvgo = $this->getParameter('app.admin_mail');

            try {
                $email = (new Email())
                    ->from($jvgo)
                    ->to($data->Email)
                    ->priority(Email::PRIORITY_HIGH)
                    ->subject("JVGO Confirmation !")
                    ->html("Bonjour {$data->Civilite}! <br>Notre collaborateur vous contactera dans les plus brefs délais pour procéder démarrer la première étape <br>et vous communiquera les modalités de notre pack création");
                    
                  $errorOrSuccess = $mailer->send($email);

            } catch (\Throwable $th) {
                $errorOrSuccess =  $th;
            }

            
            
            return $this->json([
                'code' => 'success',
                'message' => 'Operation effectuée' /*,
                'email' =>  $errorOrSuccess */
            ]);
        } else {

            return $this->json([
                'code' => 'error',
                'message' => 'data-raw body vide'
            ]);
        }
    }


}
