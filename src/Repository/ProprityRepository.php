<?php

namespace App\Repository;

use App\Entity\PropertySearch;
use App\Entity\Proprity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\DocBlock\Tags\Property;

/**
 * @method Proprity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Proprity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Proprity[]    findAll()
 * @method Proprity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProprityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Proprity::class);
    }


    /**
     * @return Query
     */

    public function findAllVisibleQuery(PropertySearch $search):Query
    {
        $query= $this->findVisibleQuery();

        if($search->getMaxPrice())
        {
            $query = $query
                   ->andWhere('p.price <= :maxprice')
                -> setParameter('maxprice',$search->getMaxPrice());

        }
        if($search->getTypeMateriel())
        {
            $query = $query
                ->andWhere('p.title like :typeMateriel')
                -> setParameter('typeMateriel',$search->getTypeMateriel());

        }
      return $query->getQuery();
    }

    /**
     * @return Proprity[]
     */

    public function findlatest() :array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();

    }
    // /**
    //  * @return Proprity[] Returns an array of Proprity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Proprity
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    private function findVisibleQuery() : \Doctrine\ORM\QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->Where('p.solde=false');
    }

}