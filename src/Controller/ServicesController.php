<?php

namespace App\Controller;

use App\Entity\Services;
use App\Form\ServicesType;
use App\Repository\ServicesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/services', name: 'app_services_')]
class ServicesController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(ServicesRepository $servicesRepository): Response
    {
        $services = $servicesRepository->findAll();
        $publishedServices = [];

        foreach ($services as $service) {
            if($service->isStatus() == false) {
                $publishedServices[] = $service;
            }
        }
        return $this->render('services/index.html.twig', [
            'services' => $publishedServices,
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $service = new Services();
        $form = $this->createForm(ServicesType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $service->setStatus(false);
            $service->setLastUpdate(new \DateTime());
            $entityManager->persist($service);
            $entityManager->flush();

            return $this->redirectToRoute('app_services_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('services/new.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }

    #[Route('/archived', name: 'archived', methods: ['GET'])]
    public function archived(ServicesRepository $servicesRepository): Response
    {
        $services = $servicesRepository->findAll();
        $publishedServices = [];
        foreach ($services as $service) {
            if($service->isStatus() == true) {
                $publishedServices[] = $service;
            }
        }
        return $this->render('services/archived.html.twig', [
            'services' => $publishedServices,
        ]);
    }
    
    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Services $service, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ServicesType::class, $service);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $service->setLastUpdate(new \DateTime());
            $entityManager->flush();
            
            return $this->redirectToRoute('app_services_index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('services/edit.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }
    
    
    #[Route('/{id}/archive', name: 'change_status', methods: ['GET', 'POST'])]
    public function editStatus(Request $request, Services $service, EntityManagerInterface $entityManager): Response
    {
        if ($service->isStatus() == true) {
            $service->setStatus(false);
            $entityManager->flush();
            
            return $this->redirectToRoute('app_services_archived', [], Response::HTTP_SEE_OTHER);
        }
        
        $service->setStatus(true);
        $entityManager->flush();

        return $this->redirectToRoute('app_services_index', [], Response::HTTP_SEE_OTHER);
    }
    
    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Services $service, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$service->getId(), $request->request->get('_token'))) {
            $entityManager->remove($service);
            $entityManager->flush();
        }
        
        return $this->redirectToRoute('app_services_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Services $service): Response
    {
        return $this->render('services/show.html.twig', [
            'service' => $service,
        ]);
    }
}
