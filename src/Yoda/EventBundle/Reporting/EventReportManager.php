<?php

namespace Yoda\EventBundle\Reporting;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class EventReportManager
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var Router
     */
    private $router;

    public function __construct(EntityManager $em, Router $router)
    {
        $this->em = $em;
        $this->router = $router;
    }

    public function getRecentlyUpdatedReport()
    {
        $events = $this->em->getRepository('EventBundle:Event')->getRecentlyUpdatedEvents();

        $rows = array();
        foreach ($events as $event){
            $data= array(
                $event->getId(),
                $event->getName(),
                $event->getTime()->format('Y-m-d H:i:s'),
                $this->router->generate('event_show', array('slug' => $event->getSlug()), true)
            );
            $rows[] = implode(',', $data);
        }
        $content = implode("\n",$rows);
        return $content;
    }
}