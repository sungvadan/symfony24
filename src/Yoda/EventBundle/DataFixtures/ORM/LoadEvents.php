<?php

namespace EventBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Yoda\EventBundle\Entity\Event;

class LoadEventsData implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = $manager->getRepository('UserBundle:User')->findOneByUsernameOrEmail('darth');
        $event = new Event();
        $event->setName('Darth\'s surprise birthday party');
        $event->setLocation('Deathstar');
        $event->setTime(new \DateTime('tomorrow noon'));
        $event->setOwner($user);
        $manager->persist($event);

        $manager->flush();
    }

    public function getOrder()
    {
        return 20;
    }
}