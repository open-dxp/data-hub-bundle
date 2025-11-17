<?php

declare(strict_types=1);


namespace OpenDxp\Bundle\DataHubBundle\Service;

use Symfony\Component\HttpFoundation\JsonResponse;

/** @internal  */
interface ResponseServiceInterface
{
    public function removeCorsHeaders(JsonResponse $response): void;

    public function addCorsHeaders(JsonResponse $response): void;
}
