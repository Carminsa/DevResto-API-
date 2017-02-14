<?php

namespace DevrestoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use DevrestoBundle\Entity\App\Product;
use Symfony\Component\HttpFoundation\Response;

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


    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $all_products_name = [];
        $array = [];

        $data = json_decode($request->getContent(), true);

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DevrestoBundle\Entity\App\User')->findOneBy(array(
            'token' => $data['token'],
        ));

        if ($user)
        {
            $repository = $this->getDoctrine()->getRepository('DevrestoBundle\Entity\App\Purchase');
            $purchase = $repository->findBy(array(
                'userId' =>$user->getId(),
            ));

            $purchase = end($purchase);

            $explode = explode(',', $purchase->getProducts());
            unset($explode[count($explode)-1]);

            $query = $this->getDoctrine()->getRepository('DevrestoBundle\Entity\App\Product');


            foreach ($explode as $value)
            {
                $products = $query->findOneBy(array(
                    'id' => $value
                ));

                array_push($all_products_name, $products);
            }

            for ($i = 0 ; $i < count($all_products_name); $i++)
            {
                $normalizers = new \Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer();
                $norm = $normalizers->normalize($all_products_name[$i]);
                array_push($array, $norm['name']);
            }

            $count = array_count_values($array);
            $name = $this->serializer->serialize($count, 'json');

            return new Response($name, 200);
        }
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $new_product = new Product();

        $new_product->setName($data['name']);
        $new_product->setCost($data['cost']);
        $new_product->setQuantity($data['quantity']);

        $validator = $this->get('validator');
        $listErrors = $validator->validate($new_product);


        if (count($listErrors) > 0) {
            return new Response("false", 404);
        } else {
            $query = $this->getDoctrine()->getManager();
            $query->persist($new_product);
            $query->flush();

            return new Response("true", 200);
        }
    }
}