<?php

namespace App\Repository;

use App\Entity\Compagny;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Compagny>
 *
 * @method Compagny|null find($id, $lockMode = null, $lockVersion = null)
 * @method Compagny|null findOneBy(array $criteria, array $orderBy = null)
 * @method Compagny[]    findAll()
 * @method Compagny[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompagnyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Compagny::class);
    }

    /**
     * @param User $user
     * @return Compagny[]
     */
    public function findByUser(User $user)
    {
        return $this->createQueryBuilder('c')
            ->join('c.users', 'u')
            ->where('u.id = :user')
            ->setParameter('user', $user->getId())
            ->getQuery()
            ->getResult();
    }
//    /**
//     * @return Compagny[] Returns an array of Compagny objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Compagny
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
