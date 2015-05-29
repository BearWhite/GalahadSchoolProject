<?php

namespace Biblio\EntityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BiblioEntityBundle:Default:index.html.twig', array('name' => $name));
    }
}
