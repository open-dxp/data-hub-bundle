<?php

declare(strict_types=1);


namespace OpenDxp\Bundle\DataHubBundle\GraphQL;

use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;

class GeneralTypeFactory
{
    use ServiceTrait;

    public static $registry = [];

    /**
     * @var string
     */
    protected $className;

    public function __construct(Service $graphQlService, string $className)
    {
        $this->className = $className;
        $this->setGraphQLService($graphQlService);
    }

    /**
     * @return mixed
     */
    public function build()
    {
        if (!isset(self::$registry[$this->className])) {
            $operatorImpl = new $this->className($this->getGraphQlService());
            self::$registry[$this->className] = $operatorImpl;
        }

        return self::$registry[$this->className];
    }
}
