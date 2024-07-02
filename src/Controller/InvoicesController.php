<?php

namespace App\Controller;

use App\Service\MailService;
use App\Entity\Invoices;
use App\Entity\User;
use App\Entity\InvoicesNumber;
use App\Form\InvoicesType;
use App\Repository\InvoicesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;


#[Route('/invoices')]
class InvoicesController extends AbstractController
{
    private Security $security;

    public function __construct(Security $security, MailService $mailService)
    {
        $this->security = $security;
        $this->mailService = $mailService;
    }

    #[Route('/', name: 'app_invoices_index', methods: ['GET'])]
    public function index(InvoicesRepository $invoicesRepository): Response
    {
        $invoice = $invoicesRepository->findAll();
        foreach ($invoice as $invoice) {
            // tous les id de la table invoices dans le tableau $id
            $id[] = $invoice->getId();
        }
        return $this->render('invoices/index.html.twig', [
            'invoices' => [
                ['D2023001', '2024-06-01', '2024-06-05', '2024-06-10', 'Voir / Modifier'],
                ['D2023002', '2024-06-02', '2024-06-06', '2024-06-11', 'Voir / Modifier'],
                ['D2023003', '2024-06-03', '2024-06-07', '2024-06-12', 'Voir / Modifier'],
                ['D2023004', '2024-06-04', '2024-06-08', '2024-06-13', 'Voir / Modifier'],
                ['D2023005', '2024-06-05', '2024-06-09', '2024-06-14', 'Voir / Modifier'],
                ['D2023006', '2024-06-06', '2024-06-10', '2024-06-15', 'Voir / Modifier'],
                ['D2023007', '2024-06-07', '2024-06-11', '2024-06-16', 'Voir / Modifier'],
                ['D2023008', '2024-06-08', '2024-06-12', '2024-06-17', 'Voir / Modifier'],
                ['D2023009', '2024-06-09', '2024-06-13', '2024-06-18', 'Voir / Modifier'],
                ['D2023010', '2024-06-10', '2024-06-14', '2024-06-19', 'Voir / Modifier'],
            ],
            // 'id' => $id,
            'headers' => ['Devis', 'Date Dernier Paiement', 'Date Dernier Envoi', 'Dernier Update', 'Action'],
        ]);
    }

    #[Route('/newdevis', name: 'app_invoices_new_devis', methods: ['GET', 'POST'])]
    public function newdevis(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $company = $user->getCompany();


        $invoice = new Invoices();
        $invoice->setInvoicesNumber($entityManager);
        $invoice->setCompany($user->getCompany());
        $invoice->setCreatedAt(new \DateTimeImmutable());

        $form = $this->createForm(InvoicesType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $invoice->setUpdateAt(new \DateTime());
            $entityManager->persist($invoice);
            $entityManager->flush();

            return $this->redirectToRoute('app_invoices_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('invoices/newdevis.html.twig', [
            'form' => $form->createView(),
            'invoice' => $invoice,
            'company' => $company,
            'user' => $user,
            'invoiceNumber' => $invoice->getInvoicesNumber()->getInvoiceNumber(),
            'headers' => ['DESCRIPTION', 'QTÉ', 'PRIX U.', 'Total HT'],
        ]);
    }

    #[Route('/newfacture', name: 'app_invoices_new_facture', methods: ['GET', 'POST'])]
    public function newfacture(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $company = $user->getCompany();


        $invoice = new Invoices();
        $invoice->setInvoicesNumber($entityManager);
        $invoice->setCompany($user->getCompany());
        $invoice->setCreatedAt(new \DateTimeImmutable());

        $form = $this->createForm(InvoicesType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $invoice->setUpdateAt(new \DateTime());
            $entityManager->persist($invoice);
            $entityManager->flush();

            return $this->redirectToRoute('app_invoices_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('invoices/newfacture.html.twig', [
            'form' => $form->createView(),
            'invoice' => $invoice,
            'company' => $company,
            'user' => $user,
            'invoiceNumber' => $invoice->getInvoicesNumber()->getInvoiceNumber(),
            'headers' => ['DESCRIPTION', 'QTÉ', 'PRIX U.', 'Total HT'],
        ]);
    }

    #[Route('/send', name: 'app_invoices_send', methods: ['GET', 'POST'])]
    public function send(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $company = $user->getCompany();
        $client = $user->getClient();
        
        var_dump("test");
        $this->mailService->sendEmail(
            // $company->getEmail(),
            'guirado.leo@gmail.com',
            // $client->getEmail(),
            'guirado.leo@gmail.com',
            'Devis n°1',
            'Bonjour, veuillez trouver ci-joint le devis n°1. Cordialement, Léo Guirado.'
        );

        return new Response('Email sent');
    }


    #[Route('/archived', name: 'archived', methods: ['GET'])]
    public function archived(InvoicesRepository $invoicesRepository): Response
    {
        return $this->render('invoices/archived.html.twig', [
            'invoices' => $invoicesRepository->findAll(),
        ]);
    }

    #[Route('/{id}/show', name: 'app_invoices_show', methods: ['GET'])]
    public function show(Invoices $invoice): Response
    {
        return $this->render('invoices/show.html.twig', [
            'invoice' => $invoice,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_invoices_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Invoices $invoice, EntityManagerInterface $entityManager): Response
    {
        $newInvoice = new Invoices();
        $newInvoice->setInvoiceNumber($invoice->getInvoiceNumber());
        $newInvoice->setLastPaymentDate($invoice->getLastPaymentDate());
        $newInvoice->setLastSendDate($invoice->getLastSendDate());
        $newInvoice->setDueDate($invoice->getDueDate());
        $newInvoice->setUpdateAt(new \DateTime());
        
        $form = $this->createForm(InvoicesType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_invoices_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->render('invoices/edit.html.twig', [
            'invoice' => $invoice,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/archive', name: 'change_status', methods: ['GET', 'POST'])]
    public function editStatus(Invoice $invoice): Response
    {
        return $this->render('invoice/archived.html.twig', [
            'invoice' => $invoice,
        ]);
    }

    #[Route('/{id}', name: 'app_invoices_delete', methods: ['POST'])]
    public function delete(Request $request, Invoices $invoice, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$invoice->getId(), $request->request->get('_token'))) {
            $invoiceNumber = $invoice->getInvoiceNumber();
            
            // Rechercher toutes les factures avec le même invoiceNumber
            $invoicesToDelete = $entityManager->getRepository(Invoices::class)->findBy(['invoiceNumber' => $invoiceNumber]);
            
            // Supprimer toutes les factures trouvées
            foreach ($invoicesToDelete as $invoiceToDelete) {
                $entityManager->remove($invoiceToDelete);
            }

            $entityManager->flush();
        }

        return $this->redirectToRoute('app_invoices_index', [], Response::HTTP_SEE_OTHER);
    }
}
