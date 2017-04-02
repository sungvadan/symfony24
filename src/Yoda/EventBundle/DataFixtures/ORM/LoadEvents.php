<?php

namespace EventBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Yoda\EventBundle\Entity\Event;

class LoadEventsData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $event = new Event();
        $event->setName('Darth\'s surprise birthday party');
        $event->setLocation('Deathstar');
        $event->setTime(new \DateTime('tomorrow noon'));
        $manager->persist($event);

        $manager->flush();
    }
}