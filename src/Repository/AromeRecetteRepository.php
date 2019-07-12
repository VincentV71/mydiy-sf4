<?php

namespace App\Repository;

use App\Entity\AromeRecette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AromeRecette|null find($id, $lockMode = null, $lockVersion = null)
 * @method AromeRecette|null findOneBy(array $criteria, array $orderBy = null)
 * @method AromeRecette[]    findAll()
 * @method AromeRecette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AromeRecetteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AromeRecette::class);
    }

    // /**
    //  * @return AromeRecette[] Returns an array of AromeRecette objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AromeRecette
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
