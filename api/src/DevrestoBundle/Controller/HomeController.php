<?php

namespace DevrestoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use DevrestoBundle\Entity\App\Purchase;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class HomeController extends Controller
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
     * @return Response
     */
    public function indexAction()
    {

        $repository = $this->getDoctrine()->getRepository('DevrestoBundle\Entity\App\Product');
        $products = $repository->findAll();

        $this->serializer = new Serializer($this->normalizers, $this->encoders);

        $products = $this->serializer->serialize($products, 'json');
        return new Response($products);

    }

    /**
     * @param Request $request
     * @return Response
     */
    public function addAction(Request $request)
    {
        $products = '';
        $data = json_decode($request->getContent(), true);

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DevrestoBundle\Entity\App\User')->findOneBy(array(
            'token' => $data['token'],
        ));

        foreach ($data['products'] as $value)
        {
            $products .= $value . ', ';
        }

        if ($user){

            $session = $request->getSession();
            $session->set('id_user', $user->getId());
            $session->set('login_user', $user->getLogin());
            $session->save();

            $em = $this->getDoctrine()->getManager();
            $last_purchase = $em->getRepository('DevrestoBundle\Entity\App\Purchase');
            $last_purchase = $last_purchase->findBy(array(
                'userId' => $user->getId(),
            ));

            if ($last_purchase)
            {
                $last_purchase = end($last_purchase);
                $last_time = $last_purchase->getcreated_at()->format('Y-m-d H:i:s');

                $date = date('Y-m-d H:i:s', strtotime('-15 minutes'));

                if ($last_time < $date)
                {
                    $product = new Purchase();
                    $product->setuser_id($this->get('session')->get('id_user'));
                    $product->setProducts($products);
                    $product->setCreatedAt(new \DateTime());
                    $query = $this->getDoctrine()->getManager();
                    $query->persist($product);
                    $query->flush();
                }
                else {

                    $last_purchase->setProducts($products);
                    $last_purchase->setCreatedAt(new \DateTime());
                    $em->flush();
                }
            } else {
                $product = new Purchase();
                $product->setuser_id($this->get('session')->get('id_user'));
                $product->setProducts($products);
                $product->setCreatedAt(new \DateTime());
                $query = $this->getDoctrine()->getManager();
                $query->persist($product);
                $query->flush();
            }
        }
        return new Response("true", 200);
    }

}