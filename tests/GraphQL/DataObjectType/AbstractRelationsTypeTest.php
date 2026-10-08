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
 * @copyright  Modification Copyright (c) OpenDXP (https://www.opendxp.io)
 * @license    https://www.gnu.org/licenses/gpl-3.0.html  GNU General Public License version 3 (GPLv3)
 */

namespace OpenDxp\Bundle\DataHubBundle\Tests\GraphQL\DataObjectType;

use Codeception\Test\Unit;
use GraphQL\Type\Definition\ObjectType;
use OpenDxp;
use OpenDxp\Bundle\DataHubBundle\GraphQL\ClassTypeDefinitions;
use OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType\HrefType;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Model\DataObject\ClassDefinition;
use OpenDxp\Model\DataObject\ClassDefinition\Data\ManyToManyObjectRelation;

class AbstractRelationsTypeTest extends Unit
{
    private array $backupDefinitions = [];

    private array $backupDataObjectDataTypes = [];

    private ObjectType $classType;

    private ObjectType $folderType;

    private Service $service;

    protected function setUp(): void
    {
        $this->classType = new ObjectType(['name' => 'object_unittest']);
        $this->folderType = new ObjectType(['name' => 'object_folder']);

        $this->backupDefinitions = ClassTypeDefinitions::$definitions;
        ClassTypeDefinitions::$definitions = ['unittest' => $this->classType];

        // the service is only used to look up the already built folder type
        $this->service = OpenDxp::getContainer()->get(Service::class);
        $this->backupDataObjectDataTypes = $this->service->getDataObjectDataTypes();
        $this->service->registerDataObjectDataTypes(['_object_folder' => $this->folderType]);
    }

    protected function tearDown(): void
    {
        ClassTypeDefinitions::$definitions = $this->backupDefinitions;
        $this->service->registerDataObjectDataTypes($this->backupDataObjectDataTypes);
    }

    public function testUnrestrictedRelationContainsObjectFolderType()
    {
        $types = $this->buildRelationType([])->getTypes();

        $this->assertContains($this->classType, $types);
        // folders are allowed relation targets if no class restriction is
        // configured, so the union has to contain the folder type as well
        $this->assertContains($this->folderType, $types);
    }

    public function testRelationRestrictedToFolderContainsObjectFolderType()
    {
        $types = $this->buildRelationType([['classes' => 'folder']])->getTypes();

        $this->assertSame([$this->folderType], $types);
    }

    public function testRelationRestrictedToClassDoesNotContainObjectFolderType()
    {
        $types = $this->buildRelationType([['classes' => 'unittest']])->getTypes();

        $this->assertSame([$this->classType], $types);
    }

    private function buildRelationType(array $classes): HrefType
    {
        $fieldDefinition = new ManyToManyObjectRelation();
        $fieldDefinition->setName('relation');
        $fieldDefinition->setClasses($classes);

        $class = new ClassDefinition();
        $class->setName('unittest');

        return new HrefType($this->service, $fieldDefinition, $class);
    }
}
