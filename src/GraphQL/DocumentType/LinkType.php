<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentType;

use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;

class LinkType extends AbstractDocumentType
{
    use ServiceTrait;

    /**
     * @param array $config
     * @param array $context
     */
    public function __construct(Service $graphQlService, $config = ['name' => 'document_link'], $context = [])
    {
        parent::__construct($graphQlService, $config);
    }

    /**
     * @param array $config
     */
    public function build(&$config)
    {
        $resolver = new \OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentResolver\Link($this->getGraphQlService());
        $resolver->setGraphQLService($this->getGraphQlService());

        $graphQlService = $this->getGraphQlService();
        $anyTargetType = $graphQlService->buildGeneralType('anytarget');

        $this->buildBaseFields($config);
        $config['fields'] = array_merge($config['fields'], [
            'internal' => Type::int(),
            'internalType' => Type::string(),
            'object' => [
                'type' => $anyTargetType,
                'resolve' => [$resolver, 'resolveObject'],
                ],
            'direct' => Type::string(),
            'linktype' => Type::string(),
            'href' => Type::string(),
            ]
        );
    }
}
