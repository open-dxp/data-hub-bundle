<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentType;

use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;

class EmailType extends AbstractDocumentType
{
    use ServiceTrait;

    /**
     * @param array $config
     * @param array $context
     */
    public function __construct(Service $graphQlService, $config = ['name' => 'document_email'], $context = [])
    {
        parent::__construct($graphQlService, $config);
    }

    /**
     * @param array $config
     */
    public function build(&$config)
    {
        $resolver = new \OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentResolver\Email();
        $resolver->setGraphQLService($this->getGraphQlService());

        $this->buildBaseFields($config);
        $config['fields'] = array_merge($config['fields'], [
                'subject' => Type::string(),
                'from' => Type::string(),
                'replyTo' => Type::string(),
                'to' => Type::string(),
                'cc' => Type::string(),
                'bcc' => Type::string(),
            ]
        );
    }
}
