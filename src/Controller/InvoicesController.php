<?php

namespace App\Controller;

use App\Entity\Invoices;
<<<<<<< HEAD
use App\Entity\User;
use App\Entity\InvoicesNumber;
=======
>>>>>>> 55d33bb (feat(invoice): add invoice & invoiceStatus)
use App\Form\InvoicesType;
use App\Repository\InvoicesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
<<<<<<< HEAD
use Symfony\Component\Security\Core\Security;

=======
>>>>>>> 55d33bb (feat(invoice): add invoice & invoiceStatus)

#[Route('/invoices')]
class InvoicesController extends AbstractController
{
<<<<<<< HEAD
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

=======
>>>>>>> 55d33bb (feat(invoice): add invoice & invoiceStatus)
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
<<<<<<< HEAD
        $user = $this->getUser(); // Use $this->getUser() directly instead of $this->security->getUser()

        $invoice = new Invoices();

        $invoice->setInvoicesNumber($entityManager);
        $invoice->setCompany($user->getCompany()); // Verify this method is implemented correctly
        $invoice->setCreatedAt(new \DateTimeImmutable());

=======
        $invoice = new Invoices();
>>>>>>> 55d33bb (feat(invoice): add invoice & invoiceStatus)
        $form = $this->createForm(InvoicesType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
<<<<<<< HEAD
=======
            $invoice->setCompany($this->getUser()); //TODO: vérifier si ça fonctionne
            $invoice->setInvoicesNumber();
>>>>>>> 55d33bb (feat(invoice): add invoice & invoiceStatus)
            $invoice->setUpdateAt(new \DateTime());
            $entityManager->persist($invoice);
            $entityManager->flush();

            return $this->redirectToRoute('app_invoices_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('invoices/new.html.twig', [
<<<<<<< HEAD
            'form' => $form->createView(),
            'invoice' => $invoice,
            'client' => $user->getCompany()->getClients(),
=======
            'invoice' => $invoice,
            'form' => $form,
>>>>>>> 55d33bb (feat(invoice): add invoice & invoiceStatus)
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
