<?php

declare(strict_types=1);

namespace OpenDxp\Bundle\DataHubBundle\Tests\Application\GraphQL;

use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ElementIdentificationTrait;

/**
 * Loads an element through the trait. Both lookups return their arguments as text.
 */
final class MockElementIdentification
{
    use ElementIdentificationTrait;

    protected function getElementById($type, $id)
    {
        return sprintf('%s %s', $type, $id);
    }

    protected function getElementByPath($type, $fullpath)
    {
        return sprintf('%s %s', $type, $fullpath);
    }
}
