<?php

namespace Yoda\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($count,$firstname)
    {
        return $this->render(
          'EventBundle:Default:index.html.twig',
            array(
                'name' => $firstname
            )
        );
    }
}
