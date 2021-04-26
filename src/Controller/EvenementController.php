<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Participation;
use App\Controller\ParticipationController;
use App\Entity\User;
use App\Form\EvenementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Service\UploaderHelper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Knp\Component\Pager\PaginatorInterface;




/**
 * @Route("/evenement")
 */
class EvenementController extends AbstractController
{
    /**
     * @Route("/indexEvent/{idUser}", name="evenement_index", methods={"GET"})
     */
    public function index($idUser): Response
    {
        $repo = $this->getDoctrine()->getRepository(Evenement::class);
        $evenements = $repo->findBy(array('idArtiste' =>$idUser));


        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
        ]);
    }
    /**
     * @Route("/eventsadmin", name="evenement_eventsadmin", methods={"GET"})
     */
    public function eventsadmin(): Response
   {
       $evenements = $this->getDoctrine()
           ->getRepository(Evenement::class)
           ->findAll();
       $users = $this->getDoctrine()
           ->getRepository(User::class)
           ->findAll();

       return $this->render('evenement/eventsadmin.html.twig', [
           'evenements' => $evenements,
           'users'   => $users,
       ]);
   }

    /**
     * @Route("/acceuilevent", name="evenement_event", methods={"GET"})
     */
    public function acceuilevent(): Response
    {


        return $this->render('evenement/event.html.twig', [

        ]);
    }
    /**
     * @Route("/acceuileventclient", name="evenement_eventclient", methods={"GET","POST"})
     */
    public function acceuileventclient(): Response
    {


        return $this->render('evenement/acceuileventclient.html.twig', [

        ]);
    }

    /**
     * @Route("/showacceuilmeseventsclient/{idUser}", name="evenement_showacceuilmeseventsclient", methods={"GET"})
     */
    public function meseventsclient(Request $request,$idUser,PaginatorInterface $paginator): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $participation = $entityManager->getRepository(Participation::class)->findBy(array('idClient' => $idUser));
        $evenements = $entityManager->getRepository(Evenement::class)->findAll();
        $events= $paginator->paginate(
            $evenements,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 1)
        );


        return $this->render('evenement/showacceuilmeseventsclient.html.twig', [
            'evenements' => $evenements,
            'participations' => $participation,
            'events'=> $events,
        ]);
    }




    /**
     * @Route("/showacceuilevent", name="evenement_showacceuilevent", methods={"GET","POST"})
     */
    public function showacceuilevent(Request $request,PaginatorInterface $paginator): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $evenements = $this->getDoctrine()
            ->getRepository(Evenement::class)
            ->findAll();

            $events= $paginator->paginate(
            $evenements,
            $request->query->getInt('page', 1),
                $request->query->getInt('limit', 1)
        );
        if($request ->isMethod("POST")){
            $titre = $request->get("titreEvent");
                if(!empty($titre)) {
                    $evenements = $entityManager->getRepository(Evenement::class)->findBy(array('titreEvent' => $titre));
                }else{
                    $evenements = $this->getDoctrine()
                        ->getRepository(Evenement::class)
                        ->findAll();
                }


            }



        return $this->render('evenement/showacceuilevents.html.twig', [
            'evenements' => $evenements,
            'events'=> $events,
        ]);
    }
    /**
     * @Route("/singleshowevent/{idEvent}", name="evenement_singleshowevent", methods={"GET"})
     */
    public function singleshowevent(Evenement $evenement): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $idevent= $evenement->getIdEvent();
        $paticipations = $entityManager->getRepository(Participation::class)->findBy(array('idEvent' => $idevent));
        return $this->render('evenement/singleshowevent.html.twig', [
            'evenement' => $evenement,
            'participations'=> $paticipations,
        ]);
    }
    /**
     * @Route("/singleshoweventclient/{idEvent}/{idUser}", name="evenement_singleshoweventclient",methods={"GET","POST"})
     */
    public function singleshoweventclient(Evenement $evenement, $idUser): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository(User::class)->find($idUser);
        $idEvent= $evenement->getIdEvent();
        $paticipations = $entityManager->getRepository(Participation::class)->findOneBy(array('idEvent' => $evenement->getIdEvent(), 'idClient' => $user->getIdUser()));

        return $this->render('evenement/singleshoweventclient.html.twig', [
            'evenement' => $evenement,
            'participations'=> $paticipations,

        ]);
    }

    /**
     * @Route("/part/{idUser}/{idEvent}", name="PartEvent", methods={"GET","POST"})
     */
    public function Participeevent(Request $request,$idUser, $idEvent): Response
    {
        $participation = new Participation();
        if ($request->isMethod("POST")) {
            $user = $this->getDoctrine()->getRepository(User::class)->find($idUser);
            $event = $this->getDoctrine()->getRepository(Evenement::class)->find($idEvent);
                $entityManager = $this->getDoctrine()->getManager();
                $participation->setIdClient($user);
                $participation->setIdEvent($event);
                $entityManager->persist($participation);
                $entityManager->flush();

                return $this->redirectToRoute('evenement_singleshoweventclient', array('idEvent' => $idEvent, 'idUser' => $idUser));


            } return $this->redirectToRoute('evenement_singleshoweventclient', array('idEvent' => $idEvent, 'idUser' => $idUser));




    }


   /**
     * @Route("/nepas/{idUser}/{idEvent}", name="nepasPartEvent", methods={"GET","POST"})
     */
    public function nepasParticipeevent(Request $request,$idUser, $idEvent): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        if ($request->isMethod("POST")) {
            $user = $this->getDoctrine()->getRepository(User::class)->find($idUser);
            $event = $this->getDoctrine()->getRepository(Evenement::class)->find($idEvent);
            $participation = $entityManager->getRepository(Participation::class)->findBy(array('idEvent' => $event->getIdEvent()));
            $participation1 = $entityManager->getRepository(Participation::class)->findBy(array('idClient' =>  $user->getIdUser()));
                foreach ($participation  as $p){
                    foreach ($participation1 as $p1){
                        if($p == $p1){
                            $entityManager->remove($p );
                            $entityManager->flush();
                            return $this->redirectToRoute('evenement_singleshoweventclient', array('idEvent' => $idEvent, 'idUser' => $idUser));

                        }
                    }

                }
        }

        return $this->redirectToRoute('evenement_singleshoweventclient', array('idEvent' => $idEvent, 'idUser' => $idUser));
    }



    /**
     * @Route("/new/{idUser}", name="evenement_new", methods={"GET","POST"})
     */
    public function new(Request $request,$idUser,EntityManagerInterface $entityManager,\Swift_Mailer $mailer): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);
        $user = $this->getDoctrine()->getRepository(User::class)->find($idUser);


        if ($form->isSubmitted() && $form->isValid()) {

            $formData=$form->getData();
            $reponse="  Mr ".$user->getNom()."  votre evenement  ".$formData->getTitreEvent()."  a été crée avec succées!!  ";
            $message = (new \Swift_Message('Ajout événement'))
                ->setFrom('irisgh2@gmail.com')
                ->setTo($user->getEmail())
                ->setBody($reponse);



            $mailer->send($message);
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageEvent']->getData();

            if($uploadedFile){


            $destination = $this->getParameter('kernel.project_dir').'/public/img/service';
            $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            #file name
            $newFilename = 'img/service/'.$originalFilename.'.'.$uploadedFile->guessExtension();

            $uploadedFile->move(
                $destination,
                $newFilename
            );
            $evenement->setImageEvent($newFilename);
            }




            $entityManager = $this->getDoctrine()->getManager();



            $datedeb = $form['dateDeb']->getData();
            $datefin = $form['dateFin']->getData();
            $dd = $datedeb->format('Y-m-d');
            $df = $datefin->format('Y-m-d');
            $evenement->setIdArtiste($user);

            $evenement->setDateDeb($dd);
            $evenement->setDateFin($df);






            $entityManager->persist($evenement);
            $entityManager->flush();


            return $this->redirectToRoute('evenement_index',array('idUser'=>$idUser));
        }

        return $this->render('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{idEvent}", name="evenement_show", methods={"GET"})
     */
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
        'evenement' => $evenement,
    ]);
    }

    /**
     * @Route("/{idEvent}/edit", name="evenement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Evenement $evenement): Response
    {
        $id = $evenement->getIdArtiste();
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $idU= $user->getidUser();



        $form = $this->createForm(EvenementType::class, $evenement);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageEvent']->getData();

            if($uploadedFile){
                $destination = $this->getParameter('kernel.project_dir').'/public/img/service';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                #file name
                $newFilename = 'img/service/'.$originalFilename.'.'.$uploadedFile->guessExtension();

                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $evenement->setImageEvent($newFilename);
            }




            $entityManager = $this->getDoctrine()->getManager();
            $datedeb = $form['dateDeb']->getData();
            $datefin = $form['dateFin']->getData();

            $dd = $datedeb->format('Y-m-d');
            $df = $datefin->format('Y-m-d');
            $evenement->setDateDeb($dd);
            $evenement->setDateFin($df);


            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('evenement_index',array('idUser'=>$idU));




        }

        return $this->render('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idEvent}", name="evenement_delete", methods={"GET","POST"})
     */
    public function delete(Request $request, Evenement $evenement): Response
    {


        $entityManager = $this->getDoctrine()->getManager();

        if ($this->isCsrfTokenValid('delete'.$evenement->getIdEvent(), $request->request->get('_token'))) {
            $paticipation = $entityManager->getRepository(Participation::class)->findBy(array('idEvent' =>$evenement));
            foreach ($paticipation as $p){

                $entityManager->remove($p);
                $entityManager->flush();

            }
            $entityManager->remove($evenement);
            $entityManager->flush();
        }


        return $this->redirectToRoute('evenement_event');
    }
    /**
     * @Route("/admin/{idEvent}", name="evenement_deleteadmin", methods={"GET","POST"})
     */
    public function deletePageAdmin(Request $request, Evenement $evenement): Response
    {


        $entityManager = $this->getDoctrine()->getManager();

        if ($this->isCsrfTokenValid('delete'.$evenement->getIdEvent(), $request->request->get('_token'))) {
            $paticipation = $entityManager->getRepository(Participation::class)->findBy(array('idEvent' =>$evenement));
            foreach ($paticipation as $p){

                $entityManager->remove($p);
                $entityManager->flush();

            }
            $entityManager->remove($evenement);
            $entityManager->flush();
        }


        return $this->redirectToRoute('evenement_eventsadmin');
    }


}
