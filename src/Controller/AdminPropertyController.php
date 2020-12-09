<?php


namespace App\Controller;


use App\Entity\Proprity;
use App\Form\PropertyType;
use App\Repository\ProprityRepository;

use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\DocBlock\Tags\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AdminPropertyController extends AbstractController

{
    /**
     * @var ProprityRepository
     */
    private $repository;

    public function __construct(ProprityRepository $repository,EntityManagerInterface $em)
    {
      $this->repository=$repository;
      $this->em =$em;
    }

    /**
     * @Route ("/admin",name="admin.property.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
       $proprities=$this->repository->findAll();

       return $this->render('admin/index.html.twig',compact('proprities'));
    }

    /**
     * @Route ("/admin/create",name="admin.property.new")
     */
    public function new(Request $request)
    {
        $proprity= new Proprity();
        $form=$this->createForm(PropertyType::class,$proprity);
        $form->handleRequest($request);   // envoie de la requête

        if ($form->isSubmitted()&& $form->isValid())
        {    $this->em->persist($proprity);
             $this->em->flush();
            $this->addFlash('success','Ajout effectué avec succès');
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render('/admin/new.html.twig', [
                'property'=>$proprity,
                'form'=>$form->createView()
            ]
        );

    }

    /**
     * @Route ("/admin/{id}",name="admin.property.edit",methods="POST|GET")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Proprity $proprity,Request $request)
    {
        // utiliser le formulaire after adding it with create form
          $form=$this->createForm(PropertyType::class,$proprity);
          $form->handleRequest($request);   // envoie de la requête

        if ($form->isSubmitted()&& $form->isValid())
        {
           $this->em->flush();
           $this->addFlash('success','Mise à jour effectué avec succès');
           return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('/admin/edit.html.twig', [
            'property'=>$proprity,
                'form'=>$form->createView()
            ]
        );
    }

    /**

     * @Route ("/admin/{id}",name="admin.property.delete",methods="DELETE")
     * @return \Symfony\Component\HttpFoundation\Response
     */

   public function delete(Proprity $proprity,Request $request)
   {
       $this->em->remove($proprity);   // entity manager supprimé
       $this->em->flush();   // envoi à la base de donnée
       $this->addFlash('success','Suppression effectuée avec succès');

       return $this->redirectToRoute('admin.property.index');
   }
}