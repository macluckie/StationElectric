<?php

namespace App\Repository;

use App\Entity\Station;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Station>
 *
 * @method Station|null find($id, $lockMode = null, $lockVersion = null)
 * @method Station|null findOneBy(array $criteria, array $orderBy = null)
 * @method Station[]    findAll()
 * @method Station[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Station::class);
    }

    /**
     * @return Station[] Returns an array of Station objects
     * @param array $position
     */
    public function findAllStationsNearMe(array $position): array
    {
        $qr =  $this->createQueryBuilder('s');
        if (count($position) > 0) {
            $latInf = $position[0] - 0.2;
            $latSup = $position[0] + 0.2;
            $qr->where('s.consolidatedLatitude >= :latInf');
            $qr->andWhere('s.consolidatedLatitude <=  :latSup');
            $qr->setParameter('latInf', $latInf);
            $qr->setParameter('latSup', $latSup);
        }
        $result = $qr->getQuery()->getResult();
        return $result;
    }
}
