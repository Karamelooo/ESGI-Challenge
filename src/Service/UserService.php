<?php
namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function hasCompanyId(User $user, $companyId): bool
    {
        // En attente de savoir comment recuperer les company de l'utilisateur
        // return $user->getCompanyId() === $companyId;

        //temporaire
        return true;
    }
}
