<?php

namespace Yoda\EventBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * EventRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventRepository extends EntityRepository
{

    public function getUpComingEvents()
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.time')
            ->andWhere('e.time > :now')
            ->setParameter('now', new \DateTime())
            ->getQuery()
            ->getResult();
    }


    /**
     * @return Event[]
     */
    public function getRecentlyUpdatedEvents()
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.createdAt >= :since')
            ->setParameter('since', new \DateTime('24 hours ago'))
            ->getQuery()
            ->getResult();
    }
}
