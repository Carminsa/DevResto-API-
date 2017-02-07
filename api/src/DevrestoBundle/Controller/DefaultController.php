<?php

namespace DevrestoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use DevrestoBundle\Entity\App\User;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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
        if ($request->isXMLHttpRequest()) {
            return new JsonResponse(array('data' => 'this is a json response'));
        }

        return new Response('This is not ajax!', 400);
    }
}
