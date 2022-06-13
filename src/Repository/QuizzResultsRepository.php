<?php

namespace App\Repository;

use App\Entity\QuizzResults;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuizzResults>
 *
 * @method QuizzResults|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuizzResults|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuizzResults[]    findAll()
 * @method QuizzResults[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizzResultsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuizzResults::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(QuizzResults $entity, bool $flush = true): void
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
    public function remove(QuizzResults $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return QuizzResults[] Returns an array of QuizzResults objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuizzResults
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
