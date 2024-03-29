<?php

namespace App\Controller;

use App\Entity\Formulaire;
use App\Form\FormulaireType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/formulaire")
 */
class FormulaireController extends AbstractController
{
    /**
     * @Route("/", name="formulaire_index", methods={"GET"})
     */
    public function index(): Response
    {
        $formulaires = $this->getDoctrine()
            ->getRepository(Formulaire::class)
            ->findAll();

        return $this->render('formulaire/index.html.twig', [
            'formulaires' => $formulaires,
        ]);
    }

    /**
     * @Route("/new", name="formulaire_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $formulaire = new Formulaire();
        $form = $this->createForm(FormulaireType::class, $formulaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formulaire);
            $entityManager->flush();

            return $this->redirectToRoute('formulaire_index');
        }

        return $this->render('formulaire/new.html.twig', [
            'formulaire' => $formulaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idForm}", name="formulaire_show", methods={"GET"})
     */
    public function show(Formulaire $formulaire): Response
    {
        return $this->render('formulaire/show.html.twig', [
            'formulaire' => $formulaire,
        ]);
    }

    /**
     * @Route("/{idForm}/edit", name="formulaire_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Formulaire $formulaire): Response
    {
        $form = $this->createForm(FormulaireType::class, $formulaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formulaire_index');
        }

        return $this->render('formulaire/edit.html.twig', [
            'formulaire' => $formulaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idForm}", name="formulaire_delete", methods={"POST"})
     */
    public function delete(Request $request, Formulaire $formulaire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formulaire->getIdForm(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formulaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('formulaire_index');
    }
}
