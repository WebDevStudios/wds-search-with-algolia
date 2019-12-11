<?php

namespace WebDevStudios\WPSWA\Vendor\Algolia\AlgoliaSearch\Http;

use WebDevStudios\WPSWA\Vendor\Psr\Http\Message\RequestInterface;
use WebDevStudios\WPSWA\Vendor\Psr\Http\Message\ResponseInterface;

interface HttpClientInterface
{
    /**
     * The method takes a PSR request and 2 timeouts, dispatch
     * the call and must return a PSR Response.
     *
     * If the HTTP layer throws exception in case of error 4xx or 5xx
     * for instance, they must be converted to a Response to keep
     * the retry strategy working as expected.
     *
     * @param int $timeout
     * @param int $connectTimeout
     *
     * @return ResponseInterface
     */
    public function sendRequest(RequestInterface $request, $timeout, $connectTimeout);
}