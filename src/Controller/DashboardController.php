<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

/*    public function getChartData(UserRepository $userRepository, Security $security): JsonResponse
    {
        $user = $security->getUser();
        $invoices = $userRepository->findBy(['user' => $user]);

        $data = [
            'labels' => [],
            'counts' => [],
        ];

        foreach ($invoices as $invoice) {
            $data['labels'][] = $invoice->getInvoiceId();
            $data['counts'][] = $invoice->getInvoiceId();
        }

        return new JsonResponse($data);
    }*/
}