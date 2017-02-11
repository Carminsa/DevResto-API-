<?php

namespace DevrestoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use DevrestoBundle\Entity\App\User;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
//use Symfony\Component\HttpFoundation\Cookie;



class DefaultController extends Controller
{


    public function indexAction(Request $request)
    {
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
//        return $this->render('default/index.html.twig', array('products' => $products));

        $response = "toto";
        return new JsonResponse($response);
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
//        $cookie_info = array(
//            'name' => 'DevResto',
//            'value' => 'GHEZEZK',
//            'time' => time() + 3600 * 24 * 7
//        );
//
//        $cookie = new Cookie($cookie_info['name'], $cookie_info['value'], $cookie_info['time'], '/', null, false, false);
//        $response = new Response();
//        $response->headers->setCookie($cookie);
//        $response->send();

        $data = json_decode($request->getContent(), true);

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DevrestoBundle\Entity\App\User')->findOneBy(array(
            'login' => $data['login_log'],
            'password' => $data['password_log']
        ));

        if ($user){

            //$session = new Session();
            $session = $request->getSession();
            //$session->start();
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
