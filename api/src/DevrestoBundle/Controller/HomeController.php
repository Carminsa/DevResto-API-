<?php

namespace DevrestoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use DevrestoBundle\Entity\App\User;
use DevrestoBundle\Entity\App\Purchase;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;



class HomeController extends Controller
{
    private $encoders;
    private $normalizers;
    private $serializer;

    public function __construct(Request $request, $token = null)
    {
        $encoders = $this->encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = $this->normalizers = array(new ObjectNormalizer());
        $this->serializer = new Serializer($normalizers, $encoders);
    }

//    public function beforeAction(Request $request = null, $token = null)
//    {
//
//        $em = $this->getDoctrine()->getManager();
//        $user = $em->getRepository('DevrestoBundle\Entity\App\User')->findOneBy(array(
//            'token' => $token,
//        ));
//
//        if ($user)
//        {
//            $session = $request->getSession();
//            $session->set('id_user', $user->getId());
//            $session->set('login_user', $user->getLogin());
//            $session->save();
//            return $session;
//        } else {
//            return false;
//        }
//    }


    public function indexAction()
    {
//        $session = $this->get('session');
//
//        if (isset($session))
//        {

        $repository = $this->getDoctrine()->getRepository('DevrestoBundle\Entity\App\Product');
        $products = $repository->findAll();

        $this->serializer = new Serializer($this->normalizers, $this->encoders);

        $products = $this->serializer->serialize($products, 'json');
        return new Response($products);

//        }
//        else {
//            return new Response("false", 404);
//        }
    }

    public function addAction(Request $request)
    {

        $data = json_decode($request->getContent(), true);

//        $test = $data['token'];
//        $product = new Purchase();

//        $product->setIdUser($this->get('session')->get('id_user'));
//        $product->setProducts('test');
//        $product->setCreatedAt(new \DateTime());
//        $query = $this->getDoctrine()->getManager();
//        $query->persist($product);
//        $query->flush();


        return new Response("true", 200);
    }

}