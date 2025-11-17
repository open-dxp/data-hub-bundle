<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType;

use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;

/**
 * Class ElementMetadataKeyValuePairInputType
 *
 * @package OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType
 */
final class ElementMetadataKeyValuePairInputType extends InputObjectType
{
    /**
     * @var static|null
     */
    protected static $instance;

    /**
     * @param array $config
     */
    public function __construct($config = [])
    {
        $config['name'] = 'element_metadata_item_key_value_pair_input';
        $this->build($config);
        parent::__construct($config);
    }

    /**
     * @return ElementMetadataKeyValuePairInputType|null
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * @param array $config
     */
    public function build(&$config)
    {
        $config['fields']['name'] = Type::string();
        $config['fields']['value'] = Type::string();
    }
}
