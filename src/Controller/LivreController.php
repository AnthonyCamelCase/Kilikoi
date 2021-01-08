<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Livre;
use App\Form\CommentaireType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


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
        ]);
    }
}
