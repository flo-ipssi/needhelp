<?php

namespace App\Middleware;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class Redirect404 
{
    private $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }
    
    /**
     * Filter the request withour route and redirect to app_home
     *
     * @param  mixed $event
     * @return void
     */
    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();

        if ( $request->attributes->get('_route') === null) {
            $homeUrl = $this->urlGenerator->generate('app_home');
            $response = new RedirectResponse($homeUrl);
            $event->setResponse($response);
        }
    }
}
