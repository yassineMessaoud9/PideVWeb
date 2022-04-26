<?php

namespace App\Repository;

use App\Entity\Agencelocation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Agencelocation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Agencelocation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Agencelocation[]    findAll()
 * @method Agencelocation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgenceLocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Agencelocation::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Agencelocation $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Agencelocation $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Agencelocation[] Returns an array of Agencelocation objects
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
    public function findOneBySomeField($value): ?Agencelocation
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
    * @return Agencelocation[] Returns an array of Agencelocation objects
    */
     
      public function findByNomAgence($value)
      {
          return $this->createQueryBuilder('u')
              ->andWhere('u.nomagence = :val')
              ->setParameter('val', $value)
              ->getQuery()
              ->getResult()
          ;
      }

}
