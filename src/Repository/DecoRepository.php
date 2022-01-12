<?php

namespace App\Repository;

use App\Entity\Deco;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Deco|null find($id, $lockMode = null, $lockVersion = null)
 * @method Deco|null findOneBy(array $criteria, array $orderBy = null)
 * @method Deco[]    findAll()
 * @method Deco[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DecoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Deco::class);
    }

    // /**
    //  * @return Deco[] Returns an array of Deco objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Deco
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
