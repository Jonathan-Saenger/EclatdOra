<?php

namespace App\Repository;

use App\Entity\EmailInscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmailInscription>
 *
 * @method EmailInscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmailInscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmailInscription[]    findAll()
 * @method EmailInscription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmailInscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmailInscription::class);
    }

    //    /**
    //     * @return EmailInscription[] Returns an array of EmailInscription objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?EmailInscription
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
