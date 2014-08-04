<?php

namespace JD\PipelineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PipelineBundle:Default:index.html.twig', array('name' => $name));
    }
}
