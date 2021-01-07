<?php

namespace App\Controller;

use App\Entity\Livre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivreController extends AbstractController
{
    /**
     * @Route("/livre/{id}", name="livre")
     */
    public function infoLivre(int $id,Request $request, Livre $livre): Response
    {

        return $this->render('livre/index.html.twig', [
            'livre' => $livre,
        ]);
    }
}
