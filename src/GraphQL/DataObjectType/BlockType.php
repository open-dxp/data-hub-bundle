<?php

/**
 * OpenDXP
 *
 * This source file is licensed under the GNU General Public License version 3 (GPLv3).
 *
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) Pimcore GmbH (https://pimcore.com)
 * @copyright  Modification Copyright (c) OpenDXP (https://www.opendxp.ch)
 * @license    https://www.gnu.org/licenses/gpl-3.0.html  GNU General Public License version 3 (GPLv3)
 */

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
