<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FakeController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeDemoBundle:Fake:index.html.twig', array(
                // ...
            ));    }

}
