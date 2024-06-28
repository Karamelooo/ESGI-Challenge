<?php

namespace App\Controller;

use App\Entity\InvoiceStatus;
use App\Form\InvoiceStatusType;
use App\Repository\InvoiceStatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/invoice/status')]
class InvoiceStatusController extends AbstractController
{
    #[Route('/', name: 'app_invoice_status_index', methods: ['GET'])]
    public function index(InvoiceStatusRepository $invoiceStatusRepository): Response
    {
        return $this->render('invoice_status/index.html.twig', [
            'invoice_statuses' => $invoiceStatusRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_invoice_status_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $invoiceStatus = new InvoiceStatus();
        $form = $this->createForm(InvoiceStatusType::class, $invoiceStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($invoiceStatus);
            $entityManager->flush();

            return $this->redirectToRoute('app_invoice_status_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('invoice_status/new.html.twig', [
            'invoice_status' => $invoiceStatus,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_invoice_status_show', methods: ['GET'])]
    public function show(InvoiceStatus $invoiceStatus): Response
    {
        return $this->render('invoice_status/show.html.twig', [
            'invoice_status' => $invoiceStatus,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_invoice_status_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, InvoiceStatus $invoiceStatus, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InvoiceStatusType::class, $invoiceStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_invoice_status_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('invoice_status/edit.html.twig', [
            'invoice_status' => $invoiceStatus,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_invoice_status_delete', methods: ['POST'])]
    public function delete(Request $request, InvoiceStatus $invoiceStatus, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$invoiceStatus->getId(), $request->request->get('_token'))) {
            $entityManager->remove($invoiceStatus);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_invoice_status_index', [], Response::HTTP_SEE_OTHER);
    }
}
