<?php

namespace App\Controller;

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

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/', name: 'app_invoices_index', methods: ['GET'])]
    public function index(InvoicesRepository $invoicesRepository): Response
    {
        return $this->render('invoices/index.html.twig', [
            'invoices' => $invoicesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_invoices_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
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

        return $this->render('invoices/new.html.twig', [
            'form' => $form->createView(),
            'invoice' => $invoice,
            'company' => $company,
            'user' => $user,
        ]);
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
