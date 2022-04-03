<?php

namespace App\Controller;

use App\Entity\Appartient;
use App\Form\AppartientType;
use App\Repository\AppartientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/appartien")
 */
class AppartienController extends AbstractController
{
    /**
     * @Route("e/", name="app_appartien_index", methods={"GET"})
     */
    public function index(AppartientRepository $appartientRepository): Response
    {
        return $this->render('appartien/index.html.twig', [
            'appartients' => $appartientRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_appartien_new", methods={"GET", "POST"})
     */
    public function new(Request $request, AppartientRepository $appartientRepository): Response
    {
        $appartient = new Appartient();
        $form = $this->createForm(AppartientType::class, $appartient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $appartientRepository->add($appartient);
            return $this->redirectToRoute('app_appartien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('appartien/new.html.twig', [
            'appartient' => $appartient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_appartien_show", methods={"GET"})
     */
    public function show(Appartient $appartient): Response
    {
        return $this->render('appartien/show.html.twig', [
            'appartient' => $appartient,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_appartien_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Appartient $appartient, AppartientRepository $appartientRepository): Response
    {
        $form = $this->createForm(AppartientType::class, $appartient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $appartientRepository->add($appartient);
            return $this->redirectToRoute('app_appartien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('appartien/edit.html.twig', [
            'appartient' => $appartient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_appartien_delete", methods={"POST"})
     */
    public function delete(Request $request, Appartient $appartient, AppartientRepository $appartientRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$appartient->getId(), $request->request->get('_token'))) {
            $appartientRepository->remove($appartient);
        }

        return $this->redirectToRoute('app_appartien_index', [], Response::HTTP_SEE_OTHER);
    }
}
