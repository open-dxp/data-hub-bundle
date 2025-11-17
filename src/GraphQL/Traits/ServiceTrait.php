<?php

declare(strict_types=1);


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\Traits;

use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;

trait ServiceTrait
{
    /**
     * @var Service
     */
    protected $graphQlService;

    /**
     * @return Service
     */
    public function getGraphQlService()
    {
        return $this->graphQlService;
    }

    public function setGraphQLService(Service $graphQlService)
    {
        $this->graphQlService = $graphQlService;
    }
}
