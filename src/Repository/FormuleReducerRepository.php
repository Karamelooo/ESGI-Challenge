<?php

namespace App\Repository;

use App\Entity\FormuleReducer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FormuleReducer>
 *
 * @method FormuleReducer|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormuleReducer|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormuleReducer[]    findAll()
 * @method FormuleReducer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormuleReducerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormuleReducer::class);
    }

//    /**
//     * @return FormuleReducer[] Returns an array of FormuleReducer objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FormuleReducer
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
