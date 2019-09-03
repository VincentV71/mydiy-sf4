<?php

namespace App\Repository;

use App\Entity\Arome;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Arome|null find($id, $lockMode = null, $lockVersion = null)
 * @method Arome|null findOneBy(array $criteria, array $orderBy = null)
 * @method Arome[]    findAll()
 * @method Arome[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AromeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Arome::class);
    }

    /**
     * Return json data from an array of Arome'Objects
     *
     */
    public function arrayOfAromesToJson(array $aromeDatas)
    {
        $json_aromes = array();
        foreach ($aromeDatas as $arome) {
            $json_aromes[] = array(
                'aro_id' => $arome->getIdAro(),
                'aro_nb_steep' => $arome->getNbJStee(),
                'aro_dos_fab' => $arome->getDosFab()
            );
        }
        return json_encode($json_aromes);
    }
}
