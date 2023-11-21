<?php

namespace App\Repository;

use App\Entity\Location;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Location>
 *
 * @method Location|null find($id, $lockMode = null, $lockVersion = null)
 * @method Location|null findOneBy(array $criteria, array $orderBy = null)
 * @method Location[]    findAll()
 * @method Location[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Location::class);
    }


    // public function findOneBy(array $criteria, ?array $orderBy = null): ?Location
    // {
    //     if (isset($criteria['countryCode']) && isset($criteria['city'])) {
    //         $qb = $this->createQueryBuilder('l');
    //         $qb->where('l.country = :countryCode')
    //             ->setParameter('countryCode', $criteria['countryCode'])
    //             ->andWhere('l.city = :city')
    //             ->setParameter('city', $criteria['city']);

    //         $query = $qb->getQuery();
    //         return $query->getOneOrNullResult();
    //     }
    //     return null;
    // }
}
