<?php

namespace App\Repository;

use App\Entity\DiasSemana;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DiasSemana>
 *
 * @method DiasSemana|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiasSemana|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiasSemana[]    findAll()
 * @method DiasSemana[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiasSemanaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DiasSemana::class);
    }

//    /**
//     * @return DiasSemana[] Returns an array of DiasSemana objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DiasSemana
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
