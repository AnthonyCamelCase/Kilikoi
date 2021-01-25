<?php

namespace App\Controller;

use App\Entity\ListeDeLecture;
use App\Entity\Utilisateur;
use App\Form\ListeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;

class MembreController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/membre", name="membre")
     */
    public function info(): Response
    {
        $utilisateur= $this->getUser();
        $listes = $utilisateur->getListeDeLectures();
        $coms = $utilisateur-> getCommentaires();

        #obligation de créer une liste de lecture pour y ajouter des livres
        if ($listes[0] == NULL) {
            return $this->redirectToRoute('liste');
        } 
        
        $livres = $listes[0]->getLivre();  
        $nbLivres = count($livres);
        
        $nbMots = 0;
        foreach ($livres as $livre) {
            $nbMots += $livre->getNombreMots();
        }
            
        return $this->render('membre/index.html.twig', [
            'listes'=> $listes,
            'nbLivres'=> $nbLivres,
            'nbMots'=> $nbMots,
            'coms'=> $coms,
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/membre/liste", name="liste")
     */
    public function ajoutLivreListe(Request $request): Response
    {
        $utilisateur = $this->getUser();

        // Partie création de commentaire, formulaire
        // On instancie l'entité commentaire

        $liste = new ListeDeLecture();

        // Créer l'objet formulaire
        $form = $this->createForm(ListeFormType::class, $liste);

        // On récupère les données saisies
        $form->handleRequest($request);

        // On vérifie si le formulaire a été envoyé et si les données sont valides
        if ($form->isSubmitted() && $form->isValid()) {
            //Ici le formulaire a été envoyé et les données sont validés
            $utilisateur->addListeDeLecture($liste);

            // on instancie Doctrine
            $doctrine = $this->getDoctrine()->getManager();

            // On hydrate $commentaire
            $doctrine->persist($liste);

            // On écrit dans la base de données
            $doctrine->flush();

            return $this->redirectToRoute('membre', [
                
            ]);
        }

        return $this->render('membre/liste.html.twig', [
            'formListe' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/membre/{pseudo}", name="visite")
     */
    public function infoPourVisiteur(Utilisateur $utilisateur): Response
    {
        //$utilisateur = $this->getDoctrine()
        //   ->getRepository(Utilisateur::class)
        //   ->findOneBy(['pseudo' => $visiteur]);

        $listes = $utilisateur->getListeDeLectures();
        $coms = $utilisateur->getCommentaires();

        #obligation de créer une liste de lecture pour y ajouter des livres
        if ($listes[0] == NULL) {
            return $this->redirectToRoute('liste');
        }

        $livres = $listes[0]->getLivre();
        $nbLivres = count($livres);
        $nbMots = 0;
        foreach ($livres as $livre) {
            $nbMots += $livre->getNombreMots();
        }

        return $this->render('membre/visiteur.html.twig', [
            'utilisateur'=> $utilisateur,
            'listes' => $listes,
            'nbLivres' => $nbLivres,
            'nbMots' => $nbMots,
            'coms' => $coms,
        ]);
    }

}