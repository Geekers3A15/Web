<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\User;
use App\Form\EvenementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Service\UploaderHelper;




/**
 * @Route("/evenement")
 */
class EvenementController extends AbstractController
{
    /**
     * @Route("/", name="evenement_index", methods={"GET"})
     */
    public function index(): Response
    {
        $evenements = $this->getDoctrine()
            ->getRepository(Evenement::class)
            ->findAll();

        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
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
     * @Route("/showacceuilevent", name="evenement_showacceuilevent", methods={"GET","POST"})
     */
    public function showacceuilevent(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $evenements = $this->getDoctrine()
            ->getRepository(Evenement::class)
            ->findAll();
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
        ]);
    }
    /**
     * @Route("/singleshowevent/{idEvent}", name="evenement_singleshowevent", methods={"GET"})
     */
    public function singleshowevent(Evenement $evenement): Response
    {
        return $this->render('evenement/singleshowevent.html.twig', [
            'evenement' => $evenement,
        ]);
    }
    public function rechercheEventTitre(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $evenement =$entityManager->getRepository(Evenement::class)->findAll();
        if($request ->isMethod("POST")){
            $titre= $request->get("titreEvent");
            $evenement= $entityManager->getRepository(Evenement::class)->findBy(array('titreEvent'=>$titre));
        }
        return $this->render('evenement/showacceuilevent.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    /**
     * @Route("/new/{idUser}", name="evenement_new", methods={"GET","POST"})
     */
    public function new(Request $request,$idUser,EntityManagerInterface $entityManager): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);
        $user = $this->getDoctrine()->getRepository(User::class)->find($idUser);


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
            $evenement->setIdArtiste($user);
            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('evenement_index');
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
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evenement_index');
        }

        return $this->render('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idEvent}", name="evenement_delete", methods={"POST"})
     */
    public function delete(Request $request, Evenement $evenement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getIdEvent(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('evenement_index');
    }
}
