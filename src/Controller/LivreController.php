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
            //$com->setArticleId($article);
            $livre->addCommentaire($com);
            $utilisateur->addCommentaire($com);
            //$date = new \DateTime('now');
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
     * @Route("/livre/{titre}/ajout", name="ajoutLivre")
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

}
