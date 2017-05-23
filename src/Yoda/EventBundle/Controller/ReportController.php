<?php

namespace Yoda\EventBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends Controller
{
    /**
     * @Route("/events/report/recentlyUpdated.csv")
     */
    public function updatedEventsAction()
    {

        $reportingManager = $this->container->get('report_event_manager');
        $content = $reportingManager->getRecentlyUpdatedReport();
        $response = new Response($content);
        $response->headers->set('Content-Type', 'text/csv');
        return $response;
    }

}