<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentType;

use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\General\AnyDocumentTargetType;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;

class HardlinkType extends AbstractDocumentType
{
    use ServiceTrait;

    protected $anyDocumentTargetType;

    /**
     * @param array $config
     * @param array $context
     */
    public function __construct(Service $graphQlService, AnyDocumentTargetType $anyDocumentTargetType, $config = ['name' => 'document_hardlink'], $context = [])
    {
        $this->anyDocumentTargetType = $anyDocumentTargetType;
        parent::__construct($graphQlService, $config);
    }

    /**
     * @param array $config
     */
    public function build(&$config)
    {
        $resolver = new \OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentResolver\Hardlink();
        $resolver->setGraphQLService($this->getGraphQlService());

        $this->buildBaseFields($config);
        $config['fields'] = array_merge($config['fields'], [
                'sourceId' => Type::int(),
                'propertiesFromSource' => Type::boolean(),
                'childrenFromSource' => Type::boolean(),
                'target' => [
                    'type' => $this->anyDocumentTargetType,
                    'resolve' => [$resolver, 'resolveTarget'],
                ],
            ]
        );
    }
}
