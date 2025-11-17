<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;
use OpenDxp\Model\DataObject\ClassDefinition;
use OpenDxp\Model\DataObject\ClassDefinition\Data;

class BlockType extends ObjectType
{
    use ServiceTrait;

    /** @var ClassDefinition */
    protected $class;

    /** @var Data */
    protected $fieldDefinition;

    /**
     * @param ClassDefinition|null $class
     * @param array $config
     */
    public function __construct(Service $graphQlService, Data $fieldDefinition, $class = null, $config = [])
    {
        $this->class = $class;
        $this->fieldDefinition = $fieldDefinition;
        $this->setGraphQLService($graphQlService);

        $this->build($config);

        parent::__construct($config);
    }

    /**
     * @param array $config
     */
    public function build(&$config)
    {
        $typeName = 'block_'.$this->class->getName().'_'.$this->fieldDefinition->getName() . '_entry';
        $type = BlockEntryType::getInstance($typeName, $this->graphQlService, $this->fieldDefinition, $this->class);

        $config['name'] = 'block_'.$this->class->getName().'_'.$this->fieldDefinition->getName();
        $config['fields'] = [
            'entries' => Type::listOf($type),
        ];
    }
}
