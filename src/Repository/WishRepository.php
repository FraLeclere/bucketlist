<?php

namespace App\Repository;

use App\Entity\Wish;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Wish|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wish|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wish[]    findAll()
 * @method Wish[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WishRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wish::class);
    }

    public function findCategorizedWishes($categoryId = null)
    {
/*        //Avec dql
        $dql = "SELECT w, c 
                FROM App\Entity\Wish w
                JOIN w.category c
                WHERE w.isPublished = 1
                ORDER BY w.dateCreated DESC
                ";

        $query = $this->getEntityManager()->createQuery($dql);*/

        $queryBuilder = $this->createQueryBuilder('w');

        $queryBuilder->addOrderBy('w.dateCreated','DESC');
        $queryBuilder
            ->andWhere('w.isPublished = :publishStatus')
            ->setParameter(':publishStatus',1)
            ->leftJoin('w.category','c')
            ->addSelect('c');

        if ($categoryId)
        {
            //Add request where !
        }

        $query = $queryBuilder->getQuery();

        $query->setMaxResults(30);

        //offset
        //$query->setFirstResult(10);

        $wishes = $query->getResult();

        return $wishes;

        //Si on a des pb de limit avec les jointures on utilise paginator
/*        $paginator = new Paginator($query);

        return $paginator;*/

    }

    // /**
    //  * @return Wish[] Returns an array of Wish objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Wish
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
