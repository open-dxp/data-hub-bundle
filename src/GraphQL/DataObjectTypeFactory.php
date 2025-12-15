<?php

declare(strict_types=1);

/**
 * OpenDXP
 *
 * This source file is licensed under the GNU General Public License version 3 (GPLv3).
 *
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) Pimcore GmbH (https://pimcore.com)
 * @copyright  Modification Copyright (c) OpenDXP (https://www.opendxp.io)
 * @license    https://www.gnu.org/licenses/gpl-3.0.html  GNU General Public License version 3 (GPLv3)
 */

namespace OpenDxp\Bundle\DataHubBundle\GraphQL;

use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;
use OpenDxp\Model\DataObject\ClassDefinition;

class DataObjectTypeFactory
{
    use ServiceTrait;

    public static $registry = [];

    protected string $className;

    public function __construct(Service $graphQlService, string $className)
    {
        $this->className = $className;
        $this->setGraphQLService($graphQlService);
    }

    /**
     * @return mixed
     */
    public function build(string $className, $config = [], $context = [])
    {
        if (!isset(self::$registry[$className])) {
            $class = ClassDefinition::getByName($className);
            $operatorImpl = new $this->className(
                $this->getGraphQlService(),
                $className,
                $class->getId(),
                $config,
                $context
            );
            self::$registry[$className] = $operatorImpl;
        }

        return self::$registry[$className];
    }
}
