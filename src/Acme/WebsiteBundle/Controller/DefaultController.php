<?php

namespace Acme\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeWebsiteBundle:Default:index.html.twig');
    }
}
