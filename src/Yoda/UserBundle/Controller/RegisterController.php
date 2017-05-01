<?php

namespace Yoda\UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class RegisterController extends Controller
{
    /**
     * @return array
     *
     * @Route("/register", name="user_register")
     * @Template()
     */
    public function RegisterAction()
    {
        $form = $this->createFormBuilder()
            ->add('username','text')
            ->add('email','text')
            ->add('password','text')
            ->getForm();
        return array('form'=> $form);
    }


}