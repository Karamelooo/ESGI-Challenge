<?php

namespace App\Repository;

use App\Entity\InvoicesNumber;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InvoicesNumber>
 *
 * @method InvoicesNumber|null find($id, $lockMode = null, $lockVersion = null)
 * @method InvoicesNumber|null findOneBy(array $criteria, array $orderBy = null)
 * @method InvoicesNumber[]    findAll()
 * @method InvoicesNumber[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InvoicesNumberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InvoicesNumber::class);
    }

//    /**
//     * @return InvoicesNumber[] Returns an array of InvoicesNumber objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?InvoicesNumber
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
