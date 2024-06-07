<?php

namespace App\Controller;

use App\Service\MailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmailController extends AbstractController
{
    private $mailService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    /**
     * @Route("/test-email", name="test_email")
     */
    public function sendEmail(): Response
    {
        $this->mailService->sendEmail(
            'hugo.petit.dev@gmail.com',
            'hugo.petit.dev@gmail.com',
            'envoi test',
            'test contenu.'
        );

        return new Response('Email sent');
    }
}
