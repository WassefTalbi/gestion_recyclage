<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }



    public function save(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function orderByMail()
{
    return $this->createQueryBuilder('s')
        ->orderBy('s.email', 'ASC')
        ->getQuery()->getResult();
}
public function orderByUsername()
{
    return $this->createQueryBuilder('s')
        ->orderBy('s.username', 'ASC')
        ->getQuery()->getResult();
}
public function findVerifiedUser(){

    $qb= $this->createQueryBuilder('s');
    $qb ->where('s.isVerified=:isVerified');
    $qb->setParameter('isVerified',true);
    return $qb->getQuery()->getResult();
}
public function findBannedUser(){

    $qb= $this->createQueryBuilder('s');
    $qb ->where('s.isBanned=:isBanned');
    $qb->setParameter('isBanned',true);
    return $qb->getQuery()->getResult();
}
}
