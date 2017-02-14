<?php

namespace DevrestoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use DevrestoBundle\Entity\App\User;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    /**
     * @return Response
     */
    public function indexAction()
    {
        return new Response("true", 200);
    }


    /**
     * @param Request $request
     * @return Response
     */
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

    /**
     * @param Request $request
     * @return Response
     */
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
