<?php

namespace DevrestoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use DevrestoBundle\Entity\App\User;
use DevrestoBundle\Entity\App\Purchase;
use DevrestoBundle\Entity\App\Product;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
//use Symfony\Component\HttpFoundation\Cookie;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class CartController extends Controller
{

    private $encoders;
    private $normalizers;
    private $serializer;

    public function __construct()
    {
        $encoders = $this->encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = $this->normalizers = array(new ObjectNormalizer());
        $this->serializer = new Serializer($normalizers, $encoders);
    }


    public function indexAction(Request $request)
    {
        $all_products_name = [];

        $data = json_decode($request->getContent(), true);

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DevrestoBundle\Entity\App\User')->findOneBy(array(
            'token' => '01596736910',
        ));

        if ($user)
        {

            $repository = $this->getDoctrine()->getRepository('DevrestoBundle\Entity\App\Purchase');
            $purchase = $repository->findBy(array(
                'userId' =>$user->getId(),
            ));

            $purchase = end($purchase);

            $explode = explode(',', $purchase->getProducts());

            $query = $this->getDoctrine()->getRepository('DevrestoBundle\Entity\App\Product');


            foreach ($explode as $value)
            {
               $products = $query->findOneBy(array(
                   'id' => $value
               ));

               array_push($all_products_name, $products);
            }
            
            $this->serializer = new Serializer($this->normalizers, $this->encoders);
            $name = $this->serializer->serialize($all_products_name, 'json');

            return new Response($name, 200);
        }

    }

}