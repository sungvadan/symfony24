<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Yoda\UserBundle\Entity\User;

class LoadUsersData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('darth');
        $user->setEmail('darth@deathstar.com');
        $user->setPassword($this->encodePassword($user,'darthPass'));


        $admin = new User();
        $admin->setUsername('wayne');
        $admin->setEmail('wayne@deathstar.com');
        $admin->setRoles(array('ROLE_ADMIN'));
        $admin->setIsActive(true);
        $admin->setPassword($this->encodePassword($admin,'waynePass'));


        $manager->persist($user);
        $manager->persist($admin);
        $manager->flush();
    }

    private function encodePassword(User $user, $plainPassword){
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
        return $encoder->encodePassword($plainPassword, $user->getSalt());
    }


    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;

    }

    public function getOrder()
    {
        return 10;
    }
}