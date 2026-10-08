<?php

declare(strict_types=1);

namespace OpenDxp\Bundle\DataHubBundle\Tests\Feature\GraphQL;

use GraphQL\Type\Definition\ObjectType;
use OpenDxp\Bundle\DataHubBundle\GraphQL\ClassTypeDefinitions;
use OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType\HrefType;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Model\DataObject\ClassDefinition;
use OpenDxp\Model\DataObject\ClassDefinition\Data\ManyToManyObjectRelation;
use OpenDxp\TestFoundation\Container;

/**
 * @param list<array{classes: string}> $classes
 */
function relationTo(Service $service, array $classes): HrefType
{
    $field = new ManyToManyObjectRelation();
    $field->setName('relation');
    $field->setClasses($classes);

    $class = new ClassDefinition();
    $class->setName('unittest');

    return new HrefType($service, $field, $class);
}

beforeEach(function () {
    $this->classType = new ObjectType(['name' => 'object_unittest']);
    $this->folderType = new ObjectType(['name' => 'object_folder']);
    $this->service = Container::get(Service::class);
    $this->definitions = ClassTypeDefinitions::$definitions;
    $this->dataTypes = $this->service->getDataObjectDataTypes();

    ClassTypeDefinitions::$definitions = ['unittest' => $this->classType];
    $this->service->registerDataObjectDataTypes(['_object_folder' => $this->folderType]);
});

afterEach(function () {
    ClassTypeDefinitions::$definitions = $this->definitions;
    $this->service->registerDataObjectDataTypes($this->dataTypes);
});

it('offers the classes and the object folder for a relation without a class restriction', function () {
    $types = relationTo($this->service, [])->getTypes();

    expect($types)->toEqualCanonicalizing([
        $this->classType,
        $this->folderType,
    ]);
});

it('offers only the object folder for a relation restricted to folders', function () {
    $types = relationTo($this->service, [['classes' => 'folder']])->getTypes();

    expect($types)->toBe([$this->folderType]);
});

it('offers no object folder for a relation restricted to a class', function () {
    $types = relationTo($this->service, [['classes' => 'unittest']])->getTypes();

    expect($types)->toBe([$this->classType]);
});
