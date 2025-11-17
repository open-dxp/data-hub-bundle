<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\Exception;

use GraphQL\Error\ClientAware;

class ClientSafeException extends \Exception implements ClientAware
{
    public function isClientSafe(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return 'opendxp.datahub';
    }
}
