<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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
