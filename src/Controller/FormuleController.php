<?php

namespace App\Controller;

use App\Entity\Formule;
use App\Form\FormuleType;
use App\Repository\FormuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/formule')]
class FormuleController extends AbstractController
{
    #[Route('/', name: 'app_formule_index', methods: ['GET'])]
    public function index(FormuleRepository $formuleRepository): Response
    {
        return $this->render('formule/index.html.twig', [
            'formules' => $formuleRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_formule_show', methods: ['GET'])]
    public function show(Formule $formule): Response
    {
        return $this->render('formule/show.html.twig', [
            'formule' => $formule,
        ]);
    }
}
