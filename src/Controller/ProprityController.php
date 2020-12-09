<?php

namespace App\Controller;
use App\Entity\PropertySearch;
use App\Entity\Proprity;
use App\Form\PropertySearchType;
use App\Repository\ProprityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

use Knp\Component\Pager\PaginatorInterface;
use phpDocumentor\Reflection\DocBlock\Tags\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ProprityController extends AbstractController {

    /**
     * @var ProprityRepository
     */
    private $repository;

    public function __construct(ProprityRepository $repository)

    {
        $this->repository=$repository;
    }


    /**
     * @Route("/biens",name="proprity")
     * @return Response

     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        /* $proprity = new Proprity();
         $proprity->setTitle('mon premier matériel')
                  ->setDescription('une petite description')
                  ->setName('tractor')
                  ->setPrice(25000)
                  ->setLocation('Bizert')

                  ->setMarque('landini')
                  ->setPuissance(20)
                  ->setTranmission('2500x1500')
                  ->setCompteur(150000);

         $em=$this->getDoctrine()->getManager(); // 1-enregistrement des données
         $em->persist($proprity); // 2-enregistrement des données
         $em->flush();  // 3-enregistrement des données*/

        //$property=$this->repository->findAllVisible();
        //dump($property);

        $search = new PropertySearch();
        $form=$this->createForm(PropertySearchType::class,$search);
        $form->handleRequest($request);

         $properties = $paginator->paginate(
             $this->repository->findAllVisibleQuery($search),
             $request->query->getInt('page',1),6
         );
        return $this->render('pages/proprities.html.twig', [
            'current_menu' => 'properties',
            'properties' =>$properties,
            'form' =>$form->createView()
        ]);
    }

    /**
     * @Route("/biens/{id}",name="property.show")
     * @return Response
     */

        public function show($id) : Response
        {
            $property=$this->repository->find($id);
           return $this->render('pages/show.html.twig', [
            'property'=>$property,
           'current_menu' => 'proprities']);
        }

}