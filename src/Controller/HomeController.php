<?php

namespace App\Controller;

use App\Repository\ProprityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeController extends AbstractController {

    /**
     * @param ProprityRepository $repository
     * @return Response
     */
    public function index(ProprityRepository $repository) : Response {

        $properties=$repository->findlatest();

         return $this->render('pages/home.html.twig', [
          'properties'=>$properties
          ]);
    }
}