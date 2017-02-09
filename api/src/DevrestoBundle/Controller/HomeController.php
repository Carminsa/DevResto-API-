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

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;



class HomeController extends Controller
{
    private $encoders;
    private $normalizers;
    private $serializer;
    private $session;

    public function __construct()
    {
        $encoders = $this->encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = $this->normalizers = array(new ObjectNormalizer());
        $this->serializer = new Serializer($normalizers, $encoders);
    }

    public function indexAction()
    {
        $session = $this->get('session');

        if (isset($session))
        {

            $repository = $this->getDoctrine()->getRepository('DevrestoBundle\Entity\App\Product');
            $products = $repository->findAll();


            $this->serializer = new Serializer($this->normalizers, $this->encoders);

            $products = $this->serializer->serialize($products, 'json');
            return new Response($products);

        }
        else {
            return new Response("false", 404);
        }
    }

}