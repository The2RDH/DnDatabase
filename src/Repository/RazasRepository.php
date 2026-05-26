<?php

namespace App\Repository;

use App\Entity\Razas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Razas>
 */
class RazasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Razas::class);
    }

    public function findAllOrderedByOrigen(): array
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.origen', 'o') // Unimos la tabla de orígenes
            ->orderBy('o.nombre', 'ASC') // Ordenamos alfabéticamente por el nombre del origen
            ->addOrderBy('r.nombre', 'ASC') // Secundario: si comparten origen, ordena por nombre de raza
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Razas[] Returns an array of Razas objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Razas
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
