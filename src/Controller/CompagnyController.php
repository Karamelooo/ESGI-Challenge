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
use Symfony\Component\Security\Core\Security;

#[Route('/compagny')]
class CompagnyController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/', name: 'app_compagny_index', methods: ['GET'])]
    public function index(CompagnyRepository $compagnyRepository): Response
    {
        $user = $this->security->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour accéder à cette page.');
        }
        
        return $this->render('compagny/index.html.twig', [
            'compagnies' => $compagnyRepository->findByUser($user),
        ]);
    }

    #[Route('/new', name: 'app_compagny_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->security->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour accéder à cette page.');
        }

        $compagny = new Compagny();
        $compagny->addUser($user);
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
        $user = $this->security->getUser();

        if (!$user || !$compagny->getUsers()->contains($user)) {
            throw $this->createAccessDeniedException('Vous ne pouvez pas éditer cette compagnie.');
        }

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
        $user = $this->security->getUser();

        if (!$user || !$compagny->getUsers()->contains($user)) {
            throw $this->createAccessDeniedException('Vous ne pouvez pas éditer cette compagnie.');
        }

        if ($this->isCsrfTokenValid('delete'.$compagny->getId(), $request->request->get('_token'))) {
            $entityManager->remove($compagny);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_compagny_index', [], Response::HTTP_SEE_OTHER);
    }
}
