<?php
declare(strict_types=1);


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryFieldConfigGenerator;

use GraphQL\Type\Definition\Type;
use OpenDxp\Model\DataObject\ClassDefinition;
use OpenDxp\Model\DataObject\ClassDefinition\Data;

/**
 * Class ImageGallery
 *
 * @package OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryFieldConfigGenerator
 */
class ImageGallery extends Base
{
    const TYPE = 'imageGallery';

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
        return $this->enrichConfig(
            $fieldDefinition,
            $class,
            $attribute,
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
     * @return \GraphQL\Type\Definition\ListOfType
     *
     * @throws \Exception
     */
    public function getFieldType(Data $fieldDefinition, $class = null, $container = null)
    {
        $hotspotType = $this->getGraphQlService()->getDataObjectTypeDefinition(Hotspotimage::TYPE);

        return Type::listOf($hotspotType);
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
        /** @var Data\ImageGallery $fieldDefinition */
        $resolver = new Helper\ImageGallery($this->getGraphQlService(), $attribute, $fieldDefinition, $class);

        return [$resolver, 'resolve'];
    }
}
