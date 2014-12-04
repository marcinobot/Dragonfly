<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PanelController extends Controller
{
    /**
     * @Route("/", name="panel_home")
     * @Template()
     */
    public function indexAction()
    {
        return array(// ...
        );
    }

}
