<?php

namespace App\Repository;

use App\Entity\Mensaje;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mensaje>
 *
 * @method Mensaje|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mensaje|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mensaje[]    findAll()
 * @method Mensaje[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MensajeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mensaje::class);
    }

    public function findConversacionesUnicasPorUsuario($usuarioId)
    {
        $qb = $this->createQueryBuilder('m')
                ->select('m')
                ->where('m.remitente = :id OR m.receptor = :id')
                ->setParameter('id', $usuarioId)
                ->orderBy('m.fecha', 'DESC'); 
        $results = $qb->getQuery()->getResult();

        $uniqueChats = [];
        foreach ($results as $result) {
            $remitente = $result->getRemitente();
            $receptor = $result->getReceptor();

            // Crear una clave única para cada combinación de remitente y receptor
            $chatKey = $remitente->getId() < $receptor->getId() ? $remitente->getId() . '-' . $receptor->getId() : $receptor->getId() . '-' . $remitente->getId();
            
            // Si la combinación única no está en el array, añadirla
            if (!isset($uniqueChats[$chatKey])) {
                $uniqueChats[$chatKey] = $result;
            }
        }

        return array_values($uniqueChats);
    }

    //    /**
    //     * @return Mensaje[] Returns an array of Mensaje objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Mensaje
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
