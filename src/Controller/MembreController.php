<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MembreController extends AbstractController
{
    /**
     * @Route("/membre", name="membre")
     */
    public function info(): Response
    {
        $utilisateur= $this->getUser();
        $listes = $utilisateur->getListeDeLectures();
        $coms = $utilisateur-> getCommentaires();
        
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
}
