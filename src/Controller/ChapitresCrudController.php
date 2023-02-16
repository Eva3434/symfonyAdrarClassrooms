<?php

namespace App\Controller;

use App\Entity\Chapitres;
use App\Form\ChapitresType;
use App\Repository\ChapitresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/chapitres/crud')]
class ChapitresCrudController extends AbstractController
{
    #[Route('/', name: 'app_chapitres_crud_vue', methods: ['GET'])]
    public function vue(ChapitresRepository $chapitresRepository): Response
    {
        return $this->render('chapitres_crud/vue.chapitres.html.twig', [
            'chapitres' => $chapitresRepository->findAll(),
        ]);
    }
    #[Route('/index', name: 'app_chapitres_crud_index', methods: ['GET'])]
    public function index(ChapitresRepository $chapitresRepository): Response
    {
        return $this->render('chapitres_crud/index.html.twig', [
            'chapitres' => $chapitresRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_chapitres_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ChapitresRepository $chapitresRepository): Response
    {
        $chapitre = new Chapitres();
        $form = $this->createForm(ChapitresType::class, $chapitre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chapitresRepository->save($chapitre, true);
            return $this->redirectToRoute('app_chapitres_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chapitres_crud/new.html.twig', [
            'chapitre' => $chapitre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_chapitres_crud_show', methods: ['GET'])]
    public function show(Chapitres $chapitre): Response
    {
        return $this->render('chapitres_crud/show.html.twig', [
            'chapitre' => $chapitre,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_chapitres_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Chapitres $chapitre, ChapitresRepository $chapitresRepository): Response
    {
        $form = $this->createForm(ChapitresType::class, $chapitre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chapitresRepository->save($chapitre, true);

            return $this->redirectToRoute('app_chapitres_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chapitres_crud/edit.html.twig', [
            'chapitre' => $chapitre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_chapitres_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Chapitres $chapitre, ChapitresRepository $chapitresRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chapitre->getId(), $request->request->get('_token'))) {
            $chapitresRepository->remove($chapitre, true);
        }

        return $this->redirectToRoute('app_chapitres_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
