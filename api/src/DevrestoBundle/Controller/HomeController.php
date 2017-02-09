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
        $session = $this->get('session');

        if (isset($session))
        {

            $repository = $this->getDoctrine()->getRepository('DevrestoBundle\Entity\App\Product');
            $products = $repository->findAll()->toArray();


            foreach ($products as $value)
            {
                foreach ($value as $v)
                {
                    var_dump($v);
                }

            }

        die;

            $t ="jdopfjsd";
            return new Response($products);

        }
        else {
            return new Response("false", 404);
        }
    }

}