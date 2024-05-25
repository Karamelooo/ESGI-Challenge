<?php

namespace App\Controller;

use App\Entity\Tax;
use App\Form\TaxType;
use App\Repository\TaxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tax')]
class TaxController extends AbstractController
{
    #[Route('/', name: 'app_tax_index', methods: ['GET'])]
    public function index(TaxRepository $taxRepository): Response
    {
        return $this->render('tax/index.html.twig', [
            'taxes' => $taxRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tax_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tax = new Tax();
        $form = $this->createForm(TaxType::class, $tax);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tax);
            $entityManager->flush();

            return $this->redirectToRoute('app_tax_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tax/new.html.twig', [
            'tax' => $tax,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tax_show', methods: ['GET'])]
    public function show(Tax $tax): Response
    {
        return $this->render('tax/show.html.twig', [
            'tax' => $tax,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tax_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tax $tax, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TaxType::class, $tax);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tax_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tax/edit.html.twig', [
            'tax' => $tax,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tax_delete', methods: ['POST'])]
    public function delete(Request $request, Tax $tax, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tax->getId(), $request->request->get('_token'))) {
            $entityManager->remove($tax);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tax_index', [], Response::HTTP_SEE_OTHER);
    }
}
