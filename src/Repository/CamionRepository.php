<?php

namespace App\Repository;

use App\Entity\Camion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Camion>
 *
 * @method Camion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Camion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Camion[]    findAll()
 * @method Camion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CamionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Camion::class);
    }

    public function save(Camion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Camion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findCamionDisponible($date)
    {

        $camion = $this->createQueryBuilder('c')
            ->leftJoin('c.missions', 'm')
            ->addSelect('m')
            ->andWhere('m.dateMission IS NULL OR m.dateMission != :date')
            ->setParameter('date', $date->format('Y-m-d'))
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();

        return $camion;
    }

    //    /**
    //     * @return Camion[] Returns an array of Camion objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Camion
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
