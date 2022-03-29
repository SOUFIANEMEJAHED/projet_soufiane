<?php

namespace App\Controller;

use App\Entity\Motscles;
use App\Form\MotsclesType;
use App\Repository\MotsclesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/motscles")
 */
class MotsclesController extends AbstractController
{
    /**
     * @Route("/", name="app_motscles_index", methods={"GET"})
     */
    public function index(MotsclesRepository $motsclesRepository): Response
    {
        return $this->render('motscles/index.html.twig', [
            'motscles' => $motsclesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_motscles_new", methods={"GET", "POST"})
     */
    public function new(Request $request, MotsclesRepository $motsclesRepository): Response
    {
        $motscle = new Motscles();
        $form = $this->createForm(MotsclesType::class, $motscle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $motsclesRepository->add($motscle);
            return $this->redirectToRoute('app_motscles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('motscles/new.html.twig', [
            'motscle' => $motscle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_motscles_show", methods={"GET"})
     */
    public function show(Motscles $motscle): Response
    {
        return $this->render('motscles/show.html.twig', [
            'motscle' => $motscle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_motscles_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Motscles $motscle, MotsclesRepository $motsclesRepository): Response
    {
        $form = $this->createForm(MotsclesType::class, $motscle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $motsclesRepository->add($motscle);
            return $this->redirectToRoute('app_motscles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('motscles/edit.html.twig', [
            'motscle' => $motscle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_motscles_delete", methods={"POST"})
     */
    public function delete(Request $request, Motscles $motscle, MotsclesRepository $motsclesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$motscle->getId(), $request->request->get('_token'))) {
            $motsclesRepository->remove($motscle);
        }

        return $this->redirectToRoute('app_motscles_index', [], Response::HTTP_SEE_OTHER);
    }
}
