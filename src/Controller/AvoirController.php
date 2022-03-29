<?php

namespace App\Controller;

use App\Entity\Avoir;
use App\Form\AvoirType;
use App\Repository\AvoirRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/avoir")
 */
class AvoirController extends AbstractController
{
    /**
     * @Route("/", name="app_avoir_index", methods={"GET"})
     */
    public function index(AvoirRepository $avoirRepository): Response
    {
        return $this->render('avoir/index.html.twig', [
            'avoirs' => $avoirRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_avoir_new", methods={"GET", "POST"})
     */
    public function new(Request $request, AvoirRepository $avoirRepository): Response
    {
        $avoir = new Avoir();
        $form = $this->createForm(AvoirType::class, $avoir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avoirRepository->add($avoir);
            return $this->redirectToRoute('app_avoir_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('avoir/new.html.twig', [
            'avoir' => $avoir,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_avoir_show", methods={"GET"})
     */
    public function show(Avoir $avoir): Response
    {
        return $this->render('avoir/show.html.twig', [
            'avoir' => $avoir,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_avoir_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Avoir $avoir, AvoirRepository $avoirRepository): Response
    {
        $form = $this->createForm(AvoirType::class, $avoir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avoirRepository->add($avoir);
            return $this->redirectToRoute('app_avoir_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('avoir/edit.html.twig', [
            'avoir' => $avoir,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_avoir_delete", methods={"POST"})
     */
    public function delete(Request $request, Avoir $avoir, AvoirRepository $avoirRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avoir->getId(), $request->request->get('_token'))) {
            $avoirRepository->remove($avoir);
        }

        return $this->redirectToRoute('app_avoir_index', [], Response::HTTP_SEE_OTHER);
    }
}
