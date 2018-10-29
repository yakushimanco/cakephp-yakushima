<?php

namespace Yakushima\Middleware;

use Cake\Core\InstanceConfigTrait;
use Cake\Http\ServerRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * SecureHttp middleware
 */
class SecureHttpMiddleware
{
    use InstanceConfigTrait;

    protected $_defaultConfig = [
        'forceSSL' => true,
    ];

    /**
     * Constructor.
     *
     * @param array $config Settings for the filter.
     */
    public function __construct($config = [])
    {
        $this->setConfig($config);
    }

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
        /**
         * 変数宣言
         */
        $config = $this->getConfig();

        /**
         * プロキシから受け取ったヘッダーからSSLかどうかを判定するdetectorを追加
         */
        $request->trustProxy = true;
        $callable = function (ServerRequest $request) {
            return $request->scheme() === 'https';
        };
        $request->addDetector('ssl', $callable);

        /**
         * SSLが強制されていてhttpでアクセスされたらリダイレクト
         */
        if ($config['forceSSL'] && !$request->is('ssl')) {
            $host = $request->host();
            $target = $request->getRequestTarget();
            $url = "https://{$host}{$target}";

            return $response->withLocation($url);
        }

        return $next($request, $response);
    }
}
