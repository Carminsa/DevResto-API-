<?php

namespace DevrestoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use DevrestoBundle\Entity\App\User;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Session\Session;

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
//
//
        var_dump($this->get('session')->get('login_user'));
        die;
//
        return $this->render('default/index.html.twig');
//        $response = "toto";
//        return new JsonResponse($response);
    }


    public function registerAction(Request $request)
    {

        $data = json_decode($request->getContent(), true);

        var_dump($data);

        $user = new User();

        $user->setLogin($data['login']);
        $user->setLastname($data['lastname']);
        $user->setFirstname($data['firstname']);
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

        $data = json_decode($request->getContent(), true);

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DevrestoBundle\Entity\App\User')->findOneBy(array(
            'login' => $data['login_log'],
            'password' => $data['password_log']
        ));

        if ($user){
            $session = $request->getSession();
            $session->start();
            $this->get('session')->set('id_user', $user->getId());
            $this->get('session')->set('login_user', $user->getLogin());
//            var_dump($user);
            return new Response("true", 200);
        }

        else {
            return new Response("false", 404);
        }


    }
}
