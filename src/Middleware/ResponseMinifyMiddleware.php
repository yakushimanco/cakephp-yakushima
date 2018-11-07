<?php

namespace Yakushima\Middleware;

use Cake\Event\Event;
use Cake\Event\EventManager;
use Cake\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use voku\helper\HtmlMin;
use Cake\Log\Log;

/**
 * ResponseMinify middleware
 */
class ResponseMinifyMiddleware
{

    /**
     * Invoke method.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request The request.
     * @param \Psr\Http\Message\ResponseInterface $response The response.
     * @param callable $next Callback to invoke the next middleware.
     * @return \Psr\Http\Message\ResponseInterface A response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next)
    {
        $callable = function (Event $event) {
            $subject = $event->getSubject();
            $response = $subject->response;
            $request = $subject->request;
            $body = $response->getBody();
            $html = (new HtmlMin())->minify($body);
            $subject->response = $response->withStringBody($html);
        };

        EventManager::instance()
            ->on('Controller.shutdown', $callable);

        return $next($request, $response);
    }
}
