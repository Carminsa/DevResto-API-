<?php

namespace DevrestoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use DevrestoBundle\Entity\App\User;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Session\Session;

class HomeController extends Controller
{

    public function indexAction()
    {
        if ($this->container->get('session')->isStarted() === true)
        {
            return new Response("true", 200);
        }

        else {
            return new Response("false", 404);
        }
    }

}