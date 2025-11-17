<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType;

use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\ListOfType;
use OpenDxp\Tool;

class LocalizedType extends InputObjectType
{
    /**
     * @var array<string, LocalizedType>
     */
    protected static $instances;

    /**
     * @param mixed $determinedType
     *
     * @return mixed
     */
    public static function getInstance($determinedType)
    {
        try {
            $determinedTypeName = $determinedType->toString();

            if ($determinedType instanceof ListOfType) {
                $determinedTypeName = $determinedType->getWrappedType()->toString() . 'List';
            }
        } catch (\Throwable $throwable) {
            return $determinedType;
        }

        if (!isset(self::$instances[$determinedTypeName])) {
            $config = ['name' => 'Localized' . $determinedTypeName];

            foreach (Tool::getValidLanguages() as $language) {
                $config['fields'][$language] = [
                    'type' => $determinedType,
                ];
            }

            self::$instances[$determinedTypeName] = new static($config);
        }

        return self::$instances[$determinedTypeName];
    }
}
