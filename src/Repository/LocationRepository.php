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

    public function findByCityAndCountry(string $city, ?string $country = null): ?Location
    {
        $qb = $this->createQueryBuilder('l');
        $qb->andWhere('l.city = :city')->setParameter('city', $city);

        if ($country) {
            $qb->andWhere('l.country = :country')->setParameter('country', $country);
        }

        return $qb->getQuery()->getOneOrNullResult();
    }
}