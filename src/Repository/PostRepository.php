<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 *
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function save(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Post[] Returns an array of Post objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Post
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
public function SortBytitre(){
    return $this->createQueryBuilder('p')
        ->orderBy('p.titre','ASC')
        ->getQuery()
        ->getResult()
        ;
}

public function SortByTdescription()
{
    return $this->createQueryBuilder('p')
        ->orderBy('p.description','ASC')
        ->getQuery()
        ->getResult()
        ;
}


public function SortByDate()
{
    return $this->createQueryBuilder('p')
        ->orderBy('p.date','ASC')
        ->getQuery()
        ->getResult()
        ;
}








public function findBytitre( $titre)
{
    return $this-> createQueryBuilder('e')
        ->andWhere('e.titre LIKE :titre')
        ->setParameter('titre','%' .$titre. '%')
        ->getQuery()
        ->execute();
}

public function findBydescription( $description)
{
    return $this-> createQueryBuilder('e')
        ->andWhere('e.description LIKE :description')
        ->setParameter('description','%' .$description. '%')
        ->getQuery()
        ->execute();
}
public function findByDate( $date)
{
    return $this-> createQueryBuilder('e')
        ->andWhere('e.date LIKE :date')
        ->setParameter('date','%' .$date. '%')
        ->getQuery()
        ->execute();
}
}
