<?php

namespace App\Repository;

use App\Entity\Recette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Recette|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recette|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recette[]    findAll()
 * @method Recette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecetteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Recette::class);
    }

    /**
     * Get all the recettes for a member
     * Return un array of arrays.
     * Each array contains : One 'recette' object, plus 5 properties
     *
     * @param int $idMember
     * @param string $status
     * @param string $sort
     * @param string $order
     *
     * @return array[]
     */
    public function getDataRecettesByMember($idMember, $status, $sort, $order)
    {
        return $this->createQueryBuilder('r')
        ->where('r.idMember = :idMember and r.affRecet = :status')
        ->addSelect(array('b.dosVg', 'b.dosPg'))
        ->innerJoin('r.idBase', 'b')
        ->addSelect('ar.dosAro')
        ->innerJoin('r.aromeRecettes', 'ar')
        ->addSelect(array('a.fabAro', 'a.nomAro'))
        ->innerJoin('ar.idAro', 'a')
        ->setParameters(array('idMember' => $idMember,
                            'status' => $status))
        ->orderBy($sort, $order)
        ->setMaxResults(100)
        ->getQuery()
        ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Recette
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
