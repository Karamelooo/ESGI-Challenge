<?php

namespace App\Controller;

use App\Entity\FormuleReducer;
use App\Form\FormuleReducerType;
use App\Repository\FormuleReducerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/formule/reducer')]
class FormuleReducerController extends AbstractController
{
    #[Route('/', name: 'app_formule_reducer_index', methods: ['GET'])]
    public function index(FormuleReducerRepository $formuleReducerRepository): Response
    {
        return $this->render('formule_reducer/index.html.twig', [
            'formule_reducers' => $formuleReducerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_formule_reducer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formuleReducer = new FormuleReducer();
        $form = $this->createForm(FormuleReducerType::class, $formuleReducer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($formuleReducer);
            $entityManager->flush();

            return $this->redirectToRoute('app_formule_reducer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('formule_reducer/new.html.twig', [
            'formule_reducer' => $formuleReducer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formule_reducer_show', methods: ['GET'])]
    public function show(FormuleReducer $formuleReducer): Response
    {
        return $this->render('formule_reducer/show.html.twig', [
            'formule_reducer' => $formuleReducer,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_formule_reducer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FormuleReducer $formuleReducer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FormuleReducerType::class, $formuleReducer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_formule_reducer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('formule_reducer/edit.html.twig', [
            'formule_reducer' => $formuleReducer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formule_reducer_delete', methods: ['POST'])]
    public function delete(Request $request, FormuleReducer $formuleReducer, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formuleReducer->getId(), $request->request->get('_token'))) {
            $entityManager->remove($formuleReducer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_formule_reducer_index', [], Response::HTTP_SEE_OTHER);
    }
}
