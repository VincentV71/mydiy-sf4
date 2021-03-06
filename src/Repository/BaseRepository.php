<?php

namespace App\Repository;

use App\Entity\Base;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Base|null find($id, $lockMode = null, $lockVersion = null)
 * @method Base|null findOneBy(array $criteria, array $orderBy = null)
 * @method Base[]    findAll()
 * @method Base[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BaseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Base::class);
    }

    /**
     * Return json data from an array of Base'Objects
     *
     */
    public function arrayOfBasesToJson(array $baseDatas)
    {
        $json_bases = array();
        foreach ($baseDatas as $base) {
            $json_bases[] = array(
                'base_id' => $base->getIdBase(),
                'base_correctif' => $base->getCorrectif(),
                'base_pg' => $base->getDosPg()
            );
        }
        return json_encode($json_bases);
    }

    // /**
    //  * @return Base[] Returns an array of Base objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Base
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
