<?php

namespace CR32\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CR32UserBundle:Default:index.html.twig');
    }
}
