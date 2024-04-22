<?php

namespace App\Repository;

use App\Entity\Annonce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Annonce>
 *
 * @method Annonce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Annonce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Annonce[]    findAll()
 * @method Annonce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnonceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Annonce::class);
    }

    public function add(Annonce $annonce) {
        $this->getEntityManager()->persist($annonce);
        $this->getEntityManager()->flush();
    }

   /**
    * @return Annonce[] Returns an array of Annonce objects
    */
   public function findByTitleField(string $searchkey): array
   {
       return $this->createQueryBuilder('a')
           ->andWhere('a.title LIKE :val')
           ->setParameter('val', '%'.$searchkey.'%')
           ->orderBy('a.title', 'ASC')
           ->getQuery()
           ->execute()
       ;
   }
}
