<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementMutationFieldConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;

class Base
{
    use ServiceTrait;

    public function __construct(Service $graphQlService)
    {
        $this->setGraphQLService($graphQlService);
    }

    public function getDocumentElementMutationFieldConfig()
    {
        throw new \Exception("needs to be implemented in the base class. let's see, maybe there are similarities");
    }
}
