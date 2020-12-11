<?php

namespace App\Controller;
use App\Entity\Contact;
use App\Entity\ContactNotification;
use App\Entity\PropertySearch;
use App\Entity\Proprity;
use App\Form\ContactType;
use App\Form\PropertySearchType;
use App\Repository\ProprityRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

        public function show(Proprity $property,Request $request, \Swift_Mailer $mailer) : Response
        {
            $contact = new Contact();
            $contact->setProperty($property);
            $form = $this->createForm(ContactType::class, $contact);
            $form->handleRequest($request);

       if($form->isSubmitted()&&$form->isValid())
       {
           $message = (new \Swift_Message('Nouvelle notification'))
               // On attribue l'expéditeur
               ->setFrom($contact->getEmail())

               // On attribue le destinataire
               ->setTo('contact@agence.fr')

               // On crée le message avec la vue Twig
               ->setBody(
                   $this->renderView(
                       'emails/notification.html.twig', compact('contact')
                   ),
                   'text/html'
               )
           ;

           // On envoie le message
           $mailer->send($message);
           $this->addFlash('success', 'Monsieur/Madame'.' '.$contact->getLastName().' Votre demande est soumise, nous vous contacterons dans les meilleurs délais');

           return $this->redirectToRoute('property.show', [
               'id'=> $property->getId(),
               'current_menu' => 'proprities',
               'form' =>$form->createView()
           ]);
       }


       return $this->render('pages/show.html.twig', [
            'property'=>$property,
           'current_menu' => 'proprities',
               'form' =>$form->createView()
            ]);
        }

}