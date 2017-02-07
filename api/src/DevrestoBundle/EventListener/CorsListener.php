<?php

namespace DevrestoBundle\EventListener;

//use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;


class CorsListener
{

    public function onKernelResponse(FilterResponseEvent $event)
    {
        $response = $event->getResponse();
        $responseHeaders = $response->headers;

        $responseHeaders->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        $responseHeaders->set('Access-Control-Allow-Origin', '*');
        $responseHeaders->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');

        $event->setResponse($response);
    }

}