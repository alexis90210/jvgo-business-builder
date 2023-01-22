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

class ProcedureDeleguerMaComptabiliteController extends AbstractController
{
    #[Route('/procedure-deleguer-ma-comptabilite/{structure}-{Abonnement}-{TypeAbonnement}-{prix}', name: 'app_procedure_deleguer_ma_comptabilite')]
    public function index(string $structure , string $Abonnement , string $TypeAbonnement , string $prix): Response
    {
        return $this->render('procedure_deleguer_ma_comptabilite/index.html.twig', [
            'typeUser' => $structure,
            'typePack' => $Abonnement,
            'Prix' => $prix,
            'TypeAbonnement' => $TypeAbonnement,
            'UserController' => $structure == 'Indépendant' ? 1 : 2
        ]);
    }

        // THIS IS CALL FROM AXIOS

        #[Route('/save/deleguer-ma-comptabilite', name: 'app_save_deleguer_ma_comptabilite', methods: ["POST"])]
        public function api(Request $request, ManagerRegistry $doctrine , MailerInterface $mailer): Response
        {
            $data = json_decode($request->getContent(), false);
    
            if ($data) {
    
                $orm = $doctrine->getManager();
    
                $demande = new Demandes();
    
                $DateCreation = date('Y-m-d');
                $data->NomEntreprise = $data->NomEntreprise ?? "";
    
                $demande->setNom($data->Nom);
                $demande->setPrenom($data->Prenom);
                $demande->setCivilite($data->Civilite);
                $demande->setEmail($data->Email);
                $demande->setStructure($data->typeUser);
                $demande->setNomStructure($data->NomEntreprise);
                $demande->setDateCreation($DateCreation);
                $demande->setDelaiCreation("Le plus tot possible");
                $demande->setFormule($data->TypeAbonnement);
                $demande->setMontant($data->Prix);
                $demande->setTypeEntreprise("");
                $demande->setTypeAbonnement($data->TypeAbonnement);
                $demande->setEntrepriseOrCompta(2); // Pour deleguer la comptabilite
                $demande->setStatus("Non repondu");
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
                        ->html("Bonjour {$data->Civilite}! <br>Notre collaborateur vous contactera dans les plus brefs délais pour procéder démarrer la première étape <br>et vous communiquera les modalités de notre pack");
                        
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
