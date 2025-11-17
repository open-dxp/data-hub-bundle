<?php
declare(strict_types=1);


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryFieldConfigGenerator;

use OpenDxp\Model\DataObject\ClassDefinition;
use OpenDxp\Model\DataObject\ClassDefinition\Data;

/**
 * Class Hotspotimage
 *
 * @package OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryFieldConfigGenerator
 */
class Hotspotimage extends Base
{
    public const TYPE = 'object_datatype_hotspotimage';

    /**
     * @param string $attribute
     * @param ClassDefinition|null $class
     * @param object|null $container
     *
     * @return array
     *
     *@throws \Exception
     *
     */
    public function getGraphQlFieldConfig($attribute, Data $fieldDefinition, $class = null, $container = null)
    {
        return $this->enrichConfig($fieldDefinition, $class, $attribute,
            [
                'name' => $fieldDefinition->getName(),
                'type' => $this->getFieldType($fieldDefinition, $class, $container),
                'resolve' => $this->getResolver($attribute, $fieldDefinition, $class),
            ],
            $container
        );
    }

    /**
     * @param ClassDefinition|null $class
     * @param object|null $container
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function getFieldType(Data $fieldDefinition, $class = null, $container = null)
    {
        $hotspotType = $this->getGraphQlService()->getDataObjectTypeDefinition('object_datatype_hotspotimage');

        return $hotspotType;
    }

    /**
     * @param string $attribute
     * @param Data $fieldDefinition
     * @param ClassDefinition $class
     *
     * @return array
     */
    public function getResolver($attribute, $fieldDefinition, $class)
    {

        /** @var Data\Hotspotimage $fieldDefinition */
        $resolver = new Helper\Hotspotimage($this->getGraphQlService(), $attribute, $fieldDefinition, $class);

        return [$resolver, 'resolve'];
    }
}
