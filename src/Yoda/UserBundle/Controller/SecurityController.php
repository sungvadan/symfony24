<?php

namespace Yoda\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SecurityController extends Controller
{
    /**
     * @Route(path="/login", name="login_form")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();

        $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
        $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);

        return array(
            'last_username' => $session->get(SecurityContextInterface::LAST_USERNAME),
            'error' => $error,
        );

    }

    /**
     * @Route(path="/login_check", name="login_check")
     */
    public function loginCheckAction()
    {

    }

    /**
     * @Route(path="/logout", name="logout")
     */
    public function logoutAction()
    {

    }

}