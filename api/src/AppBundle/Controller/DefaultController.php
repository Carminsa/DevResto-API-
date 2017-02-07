<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request, FilterResponseEvent $event)
    {
//        $name = "toto";
//        $response = new Response(json_encode(array('name' => $name)));
//        $response->headers->set('Content-Type', 'application/json');
//
//        return $response;
    }
}
