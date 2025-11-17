<?php


namespace OpenDxp\Bundle\DataHubBundle\Service;

use OpenDxp\Bundle\DataHubBundle\Configuration;
use Symfony\Component\HttpFoundation\Request;

class CheckConsumerPermissionsService
{
    public const TOKEN_HEADER = 'X-API-Key';

    public function performSecurityCheck(Request $request, Configuration $configuration): bool
    {
        $securityConfig = $configuration->getSecurityConfig();
        if ($securityConfig['method'] === Configuration::SECURITYCONFIG_AUTH_APIKEY) {
            $apiKey = $request->headers->get('apikey');
            if (empty($apiKey)) {
                $apiKey = $request->headers->get(static::TOKEN_HEADER);
            }
            if (empty($apiKey)) {
                $apiKey = $request->query->getString('apikey');
            }
            if (is_array($securityConfig['apikey'])) {
                return in_array($apiKey, $securityConfig['apikey']);
            } else {
                return $apiKey === $securityConfig['apikey'];
            }
        }

        return false;
    }
}
