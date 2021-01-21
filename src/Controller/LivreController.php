<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Livre;
use App\Form\CommentaireType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class LivreController extends AbstractController
{
    /**
     * @Route("/livre/{titre}", name="livre")
     */
    public function infoLivre(Livre $livre, Request $request): Response
    {   
        #$livres = $this->getDoctrine()
        #    ->getRepository(Livre::class)
        #    ->findOneBy(['titre' => $titre]);
        $utilisateur= $this->getUser();
        
        #si non connecté, il n'y a pas de liste de lecture.
        if ($utilisateur == NULL){
            $testlivre=NULL;
            $listes[0]=NULL;
        }
        #si oui, possibilité d'ajouter le livre à la liste si il ne l'a pas fait.
        else{
            $listes = $utilisateur->getListeDeLectures();
            #dd($listes[0]);
            if ($listes[0] == NULL){
                $testlivre = NULL;
            }
            else{
                $testlivre = $listes[0]->getLivre();
            }   
        }

        $coms = $livre->getCommentaires();

        // Partie création de commentaire, formulaire
        // On instancie l'entité commentaire
        
        $com = new Commentaire();

        // Créer l'objet formulaire
        $form = $this->createForm(CommentaireType::class, $com);

        // On récupère les données saisies
        $form->handleRequest($request);

        // On vérifie si le formulaire a été envoyé et si les données sont valides
        if ($form->isSubmitted() && $form->isValid()) {
            //Ici le formulaire a été envoyé et les données sont validés
            $livre->addCommentaire($com);
            $utilisateur->addCommentaire($com);

            // on instancie Doctrine
            $doctrine = $this->getDoctrine()->getManager();

            // On hydrate $commentaire
            $doctrine->persist($com);

            // On écrit dans la base de données
            $doctrine->flush();

            return $this->redirectToRoute('livre', [
                'titre' => $livre->getTitre(),
            ]);
        }

        return $this->render('livre/index.html.twig', [
            'livre' => $livre,
            'coms' => $coms,
            'formCommentaire'=> $form->createView(),
            'liste' => $listes[0],
            'testlivre'=> $testlivre,
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/livre/{titre}/ajoutLivre", name="ajoutLivre")
     */
    public function ajoutLivre(Livre $livre, Request $request): Response
    {
        $utilisateur = $this->getUser();
        $listes = $utilisateur->getListeDeLectures();
        $liste = $listes[0];

        #obligation de créer une liste de lecture pour y ajouter des livres
        if ($liste == NULL) {
            return $this->redirectToRoute('liste');
        }

        //ajout du livre à la liste de lecture de l'utilisateur
        $liste->addLivre($livre);

        // on instancie Doctrine
        $doctrine = $this->getDoctrine()->getManager();

        // On hydrate $commentaire
        $doctrine->persist($liste);

        // On écrit dans la base de données
        $doctrine->flush();

        return $this->redirectToRoute('livre', [
            'titre' => $livre->getTitre(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/livre/{com}/supprimerCom", name="supprimerCom")
     */
    public function supprimerCom(Commentaire $com, Request $request): Response
    {
        // on instancie Doctrine
        $doctrine = $this->getDoctrine()->getManager();

        // On hydrate $commentaire
        $doctrine->remove($com);

        // On écrit dans la base de données
        $doctrine->flush();

        return $this->redirectToRoute('membre');
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/livre/{com}/editerCom", name="editerCom")
     */
    public function editerCom(Commentaire $com, Request $request): Response
    {
        // Créer l'objet formulaire
        $form = $this->createForm(CommentaireType::class, $com);

        
        $commentaire = $com->getContenu();

        // On récupère les données saisies
        $form->handleRequest($request);

        // On vérifie si le formulaire a été envoyé et si les données sont valides
        if ($form->isSubmitted() && $form->isValid()) {
            //Ici le formulaire a été envoyé et les données sont validés

            // on instancie Doctrine
            $doctrine = $this->getDoctrine()->getManager();

        
            // On écrit dans la base de données
            $doctrine->flush();

            return $this->redirectToRoute('membre');
        }

        return $this->render('/livre/editer.html.twig', [
            'commentaire' => $commentaire,
            'formCommentaire' => $form->createView(),
            'com'=>$com,
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/livre/{titre}/supprimerLivre", name="supprimerLivre")
     */
    public function supprimerLivre(Livre $livre, Request $request): Response
    {
        $utilisateur = $this->getUser();
        $listes = $utilisateur->getListeDeLectures();
        $liste = $listes[0];
        
        //ajout du livre à la liste de lecture de l'utilisateur
        $liste->removeLivre($livre);

        // on instancie Doctrine
        $doctrine = $this->getDoctrine()->getManager();

        // On hydrate $livre
        $doctrine->persist($liste);

        // On écrit dans la base de données
        $doctrine->flush();

        return $this->redirectToRoute('membre');
    }

    /**
     * @Route("/search", name="search")
     */
    public function searchAction(Request $request):Response
    {
        $titre = $request->request->get('search');
        $livre = $this->getDoctrine()->getManager()
            ->getRepository(Livre::class)
            ->findOneBy(['titre'=> $titre]);

        if ($livre == NULL) {
            return $this->redirectToRoute('accueil');
        }
        else {
            return $this->redirectToRoute('livre',[
            'titre' => $livre->getTitre()]);
        }
    }
}