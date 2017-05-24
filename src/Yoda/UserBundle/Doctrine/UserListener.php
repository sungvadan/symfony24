<?php

namespace Yoda\UserBundle\Doctrine;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Yoda\UserBundle\Entity\User;

class UserListener
{

    private $encoderFactory;

    public function __construct(EncoderFactory $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    public function prePersist(LifecycleEventArgs $args){
        $entity = $args->getObject();
        if($entity instanceof User){
            $this->encodePassword($entity);
        }
    }

    public function preUpdate(LifecycleEventArgs $args){
        $entity = $args->getObject();
        if($entity instanceof User){
            $this->encodePassword($entity);
        }
    }

    private function encodePassword(User $user){
        $plainPassword = $user->getPlainPassword();
        if(!$plainPassword)
            return;
        $encoder = $this->encoderFactory->getEncoder($user);
        $user->setPassword($encoder->encodePassword($plainPassword, $user->getSalt()));
    }
}