<?php

namespace App\Controller;

use App\Entity\Livre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;

class AccueilController extends AbstractController
{
    /**
     * @Route("", name="accueil")
     */
    public function index(): Response
    {
        $livres = $this->getDoctrine()
                    ->getRepository(Livre::class)
                    ->findAll();

        $i = rand(0,count($livres)-1);
        $j = rand(0, count($livres)-1);
        $k = rand(0, count($livres)-1);
        $l = rand(0, count($livres)-1);
        $m = rand(0, count($livres)-1);


        return $this->render('accueil/index.html.twig', [
            'livres' => $livres,
            'i'=> $i,
            'j' => $j,
            'k' => $k,
            'l' => $l,
            'm' => $m,
        ]);
    }
}


