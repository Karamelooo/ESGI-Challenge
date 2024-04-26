<?php

namespace App\Controller;

use App\Entity\Compagny;
use App\Form\CompagnyType;
use App\Repository\CompagnyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/compagny')]
class CompagnyController extends AbstractController
{
    #[Route('/', name: 'app_compagny_index', methods: ['GET'])]
    public function index(CompagnyRepository $compagnyRepository): Response
    {
        return $this->render('compagny/index.html.twig', [
            'compagnies' => $compagnyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_compagny_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $compagny = new Compagny();
        $form = $this->createForm(CompagnyType::class, $compagny);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $logoFile = $form->get('logo_path')->getData();
            if ($logoFile) {
                $newFilename = uniqid().'.'.$logoFile->guessExtension();
                try {
                    $logoFile->move(
                        $this->getParameter('dossier_destination'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Gérer l'exception si nécessaire
                }

                // Mettez à jour le nom de fichier dans l'entité
                $compagny->setLogoPath($newFilename);
            }
            $compagny->setCreatedAt(new \DateTime());
            $entityManager->persist($compagny);
            $entityManager->flush();

            return $this->redirectToRoute('app_compagny_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('compagny/new.html.twig', [
            'compagny' => $compagny,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_compagny_show', methods: ['GET'])]
    public function show(Compagny $compagny): Response
    {
        return $this->render('compagny/show.html.twig', [
            'compagny' => $compagny,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_compagny_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Compagny $compagny, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CompagnyType::class, $compagny);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_compagny_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('compagny/edit.html.twig', [
            'compagny' => $compagny,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_compagny_delete', methods: ['POST'])]
    public function delete(Request $request, Compagny $compagny, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$compagny->getId(), $request->request->get('_token'))) {
            $entityManager->remove($compagny);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_compagny_index', [], Response::HTTP_SEE_OTHER);
    }
}
