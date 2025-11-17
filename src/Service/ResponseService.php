<?php

declare(strict_types=1);


namespace OpenDxp\Bundle\DataHubBundle\Service;

use Symfony\Component\HttpFoundation\JsonResponse;

/** @internal */
final class ResponseService implements ResponseServiceInterface
{
    /**
     * Removes CORS headers including Access-Control-Allow-Origin that should not be cached.
     */
    public function removeCorsHeaders(JsonResponse $response): void
    {
        $response->headers->remove('Access-Control-Allow-Origin');
        $response->headers->remove('Access-Control-Allow-Credentials');
        $response->headers->remove('Access-Control-Allow-Methods');
        $response->headers->remove('Access-Control-Allow-Headers');
    }

    public function addCorsHeaders(JsonResponse $response): void
    {
        $origin = '*';
        if (!empty($_SERVER['HTTP_ORIGIN'])) {
            $origin = $_SERVER['HTTP_ORIGIN'];
        }

        $response->headers->set('Access-Control-Allow-Origin', $origin);
        $response->headers->set('Access-Control-Allow-Credentials', 'true');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, X-Auth-Token');
    }
}
