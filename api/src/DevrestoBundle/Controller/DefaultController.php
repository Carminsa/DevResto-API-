<?php

namespace DevrestoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
//        return $this->render('DevrestoBundle:Default:index.html.twig');
        $response = "toto";
        return new JsonResponse($response);
    }

    /**
     * @Route("/register")
     */
    public function registerAction(Request $request)
    {

    }
}
