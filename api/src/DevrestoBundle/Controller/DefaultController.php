<?php

namespace DevrestoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use DevrestoBundle\Entity\App\User;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
//use Symfony\Component\HttpFoundation\Cookie;

use DevrestoBundle\Entity\App\Purchase;


class DefaultController extends Controller
{

    public function indexAction()
    {
        //        return $this->render('default/index.html.twig', array('products' => $last_purchase  ));

        $response = "toto";
        return new Response("true", 200);
        //
//        $em = $this->getDoctrine()->getManager();
//        $user = $em->getRepository('DevrestoBundle\Entity\App\User')->findOneBy(array(
//            'login' => 'root',
//            'password' => 'root'
//        ));
//
//        if ($user){
//            $session = $request->getSession();
//            $session->start();
//            $this->get('session')->set('id_user', $user->getId());
//            $this->get('session')->set('login_user', $user->getLogin());
//            }
//        var_dump($this->get('session')->get('id_user'));
//        return $this->render('default/index.html.twig');
//        die;


//        $repository = $this->getDoctrine()->getRepository('DevrestoBundle\Entity\App\Product');
//        $products = $repository->findAll();
//
//        var_dump($products);
//        die;
//

//        $em = $this->getDoctrine()->getManager();
//        $last_purchase = $em->getRepository('DevrestoBundle\Entity\App\Purchase');
//        $last_purchase = $last_purchase->findBy(array(
//            'userId' => 1,
//        ));
//        $last_purchase = end($last_purchase);
//        $last_time = $last_purchase->getcreated_at()->format('Y-m-d H:i:s');
//
//        $last_purchase->setProducts('gsdghsdioghsdiog');
//        $last_purchase->setCreatedAt(new \DateTime());
//        $em->flush();
//
//        print_r($last_purchase);
//        die;
//
//        $date = date('Y-m-d H:i:s', strtotime('-15 minutes'));
//
//        if ($last_purchase <  $date)
//        {
//            echo "yes" . "\n";
//        }
//        else {
//            echo "non" . "\n";
//        }
//
//        print_r($last_purchase);
//
//        echo "-----------------";

//        print_r($date);
//        die;

//        $last_purchase = count($last_purchase)-1;

    }


    public function registerAction(Request $request)
    {

        $key_len = 12;
        $key = "";

        $data = json_decode($request->getContent(), true);

        for ($i = 1 ; $i < $key_len ; $i++)
        {
            $key .= mt_rand(0,9);
        }

        $user = new User();

        $user->setLogin($data['login']);
        $user->setLastname($data['lastname']);
        $user->setFirstname($data['firstname']);
        $user->setToken($key);
        $user->setCreatedAt(new \DateTime());
        $user->setPassword($data['password']);

        $validator = $this->get('validator');
        $listErrors = $validator->validate($user);

        var_dump($data['password']);

        if (count($listErrors) > 0) {
            return new Response("false", 404);
        } else {
            $query = $this->getDoctrine()->getManager();
            $query->persist($user);
            $query->flush();

            return new Response("true", 200);
        }
    }

    public function loginAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DevrestoBundle\Entity\App\User')->findOneBy(array(
            'login' => $data['login_log'],
            'password' => hash('ripemd160', $data['password_log'])
        ));

        if ($user){
            $session = $request->getSession();
            $session->set('id_user', $user->getId());
            $session->set('login_user', $user->getLogin());
            $session->save();

            $response = $user->getToken();

            return new Response($response, 200);
        }
        else {
            return new Response("false", 404);
        }


    }
}
