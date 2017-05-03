<?php

namespace Yoda\UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Yoda\UserBundle\Entity\User;
use Yoda\UserBundle\Form\RegisterFormType;

class RegisterController extends Controller
{
    /**
     * @return array
     *
     * @Route("/register", name="user_register")
     * @Template()
     */
    public function RegisterAction(Request $request)
    {
        $user = new User();
        $user->setUsername('Leia');
        $form = $this->createForm(new RegisterFormType(), $user);
        $form->handleRequest($request);
        if($form->isValid()){
            $user->setPassword($this->encodePassword($user, $user->getPlainPassword()));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $request->getSession()->getFlashBag()
                ->add('success','Welcome to the death star. Have a nice day');

            $this->autheticateUser($user);
            $url = $this->generateUrl('event');
            return $this->redirect($url);
        }
        return array('form'=> $form->createView());
    }

    private function encodePassword(User $user, $plainPassword){
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
        return $encoder->encodePassword($plainPassword, $user->getSalt());
    }
    private function autheticateUser(User $user)
    {
        $providerKey = 'secured_area';
        $token = new UsernamePasswordToken($user, null, $providerKey, $user->getRoles());
        $this->container->get('security.context')->setToken($token);
    }


}