<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;



$loader = require_once __DIR__.'/app/bootstrap.php.cache';
Debug::enable();

require_once __DIR__.'/app/AppKernel.php';

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$kernel->boot();

$container = $kernel->getContainer();
$container->enterScope('request');
$container->set('request',$request);


// all the setup is done !!! Woo hoo
$templating = $container->get('templating');
echo $templating->render('EventBundle:Default:index.html.twig', array('name'=>'test'));

use Yoda\EventBundle\Entity\Event;

$event = new Event();
$event->setName('Darth\'s surprise birthday party');
$event->setLocation('Deathstar');
$event->setTime(new \DateTime('tomorrow noon'));

$em = $container->get('doctrine')->getManager();
$em->persist($event);
$em->flush();