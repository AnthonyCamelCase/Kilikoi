<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Entity\Utilisateur;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;

class AccueilController extends AbstractController
{
    /**
     * @Route("", name="accueil")
     */
    public function index(LivreRepository $livres): Response
    {
        #$livres = $this->getDoctrine()
        #            ->getRepository(Livre::class)
        #            ->findAll();
          
        $livres = $livres->findAll();

        $i = rand(0,count($livres)-1);
        $j = rand(0, count($livres)-1);
        $k = rand(0, count($livres)-1);
        $l = rand(0, count($livres)-1);
        $m = rand(0, count($livres)-1);

        $classement = $this->getDoctrine()
                        ->getRepository(Utilisateur::class)
                        ->findby(array(), array('nbMots' => 'DESC'));

        $nbLecteur = $this->getDoctrine()
            ->getRepository(Livre::class)
            ->findby(array(), array('nbLecteur' => 'DESC'), $limit = 5);

        return $this->render('accueil/index.html.twig', [
            'livres' => $livres,
            'i'=> $i,
            'j' => $j,
            'k' => $k,
            'l' => $l,
            'm' => $m,
            'classement'=> $classement,
            "nbLecteur"=> $nbLecteur,
        ]);
    }
}


