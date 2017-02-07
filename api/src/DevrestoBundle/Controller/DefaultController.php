<?php

namespace DevrestoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use DevrestoBundle\Entity\App\User;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $response = "toto";
        return new JsonResponse($response);
    }

    /**
     * @Route("/register")
     */
    public function registerAction(Request $request)
    {
        $count = 0;
        $data = json_decode($request->getContent(), true);

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
            $count++;
            return new Response("true", 200);
        }
    }
}
