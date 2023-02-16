<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/cours/crud')]
class CoursCrudController extends AbstractController
{
    #[Route('/', name: 'app_cours_crud_vue', methods: ['GET'])]
    public function vue(CoursRepository $coursRepository): Response
    {
        return $this->render('cours_crud/vue.cours.html.twig', [
            'cours' => $coursRepository->findAll(),
        ]);
    }
    #[Route('/index', name: 'app_cours_crud_index', methods: ['GET'])]
    public function index(CoursRepository $coursRepository): Response
    {
        return $this->render('cours_crud/index.html.twig', [
            'cours' => $coursRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cours_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CoursRepository $coursRepository, SluggerInterface $slugger): Response
    {
        $cour = new Cours();
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageCoursFile = $form->get('image_cour')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($imageCoursFile) {
                $originalFilename = pathinfo($imageCoursFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageCoursFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $imageCoursFile->move(
                        $this->getParameter('imageCours_directory'),
                        $newFilename
                    );
                    $cour->setImageCour($newFilename);
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
            }
            $coursRepository->save($cour, true);
            
            return $this->redirectToRoute('app_cours_crud_index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->renderForm('cours_crud/new.html.twig', [
            'cour' => $cour,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_cours_crud_show', methods: ['GET'])]
    public function show(Cours $cour): Response
    {
        return $this->render('cours_crud/show.html.twig', [
            'cour' => $cour,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cours_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cours $cour, CoursRepository $coursRepository): Response
    {
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $coursRepository->save($cour, true);

            return $this->redirectToRoute('app_cours_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cours_crud/edit.html.twig', [
            'cour' => $cour,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cours_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Cours $cour, CoursRepository $coursRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $cour->getId(), $request->request->get('_token'))) {
            $coursRepository->remove($cour, true);
        }

        return $this->redirectToRoute('app_cours_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
