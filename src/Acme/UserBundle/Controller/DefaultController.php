<?php

namespace Acme\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeUserBundle:Default:index.html.twig');
    }

    public function testAction()
    {
        if ( $this->get('security.context')->isGranted('ROLE_USER')) {
            return $this->render('AcmeUserBundle:Default:test.html.twig', array('name' => 'yes'));
        }
        return $this->render('AcmeUserBundle:Default:test.html.twig', array('name' => 'no'));
    }
}
