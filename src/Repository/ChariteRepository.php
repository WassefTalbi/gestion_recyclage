<?php

namespace App\Repository;

use App\Entity\Charite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Charite>
 *
 * @method Charite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Charite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Charite[]    findAll()
 * @method Charite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChariteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Charite::class);
    }

    public function save(Charite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Charite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Charite[] Returns an array of Charite objects
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

//    public function findOneBySomeField($value): ?Charite
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
public function SortByNomCharite(){
    return $this->createQueryBuilder('e')
        ->orderBy('e.nomCharite','ASC')
        ->getQuery()
        ->getResult()
        ;
}

public function SortByLieuCharite()
{
    return $this->createQueryBuilder('e')
        ->orderBy('e.lieuCharite','ASC')
        ->getQuery()
        ->getResult()
        ;
}


public function SortByTypeCharite()
{
    return $this->createQueryBuilder('e')
        ->orderBy('e.typeCharite','ASC')
        ->getQuery()
        ->getResult()
        ;
}








public function findByNomCharite( $nomCharite)
{
    return $this-> createQueryBuilder('e')
        ->andWhere('e.nomCharite LIKE :nomCharite')
        ->setParameter('nomCharite','%' .$nomCharite. '%')
        ->getQuery()
        ->execute();
}
public function findByLieuCharite( $lieuCharite)
{
    return $this-> createQueryBuilder('e')
        ->andWhere('e.lieuCharite LIKE :lieuCharite')
        ->setParameter('lieuCharite','%' .$lieuCharite. '%')
        ->getQuery()
        ->execute();
}
public function findByTypeCharite( $typeCharite)
{
    return $this-> createQueryBuilder('e')
        ->andWhere('e.typeCharite LIKE :typeCharite')
        ->setParameter('typeCharite','%' .$typeCharite. '%')
        ->getQuery()
        ->execute();
}

}
