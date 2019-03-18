<?php

namespace Urbania\AppleNews\Api;

use Carbon\Carbon;
use Psr\Http\Message\RequestInterface;

class HMACMiddleware
{
    private $key;

    private $secret;

    public function __construct($key, $secret)
    {
        $this->key = $key;
        $this->secret = $secret;
    }

    public function __invoke(callable $handler)
    {
        return function (RequestInterface $request, array $options) use ($handler) {
            $request = $request->withAddedHeader(
                'Authorization',
                $this->getHeaderValue($request)
            );
            return $handler($request, $options);
        };
    }

    protected function getHeaderValue(RequestInterface $request)
    {
        $date = Carbon::now()->toIso8601String();
        $signature = $this->getSignature($request, $date);
        return sprintf('HHMAC; key=%s; signature=%s; date=%s', $this->key, $signature, $date);
    }

    protected function getSignature(RequestInterface $request, $date)
    {
        $method = $request->getMethod();
        $parts = [
            $method,
            $request->getUri(),
            $date,
        ];
        if ($method === 'POST') {
            $parts[] = $request->getHeader('Content-type');
            $parts[] = (string) $response->getBody();
        }
        return base64_encode(hash_hmac('sha256', implode('', $parts), base64_decode($this->secret), true));
    }
}
