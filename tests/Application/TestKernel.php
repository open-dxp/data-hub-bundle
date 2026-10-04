<?php

declare(strict_types=1);

namespace OpenDxp\Bundle\DataHubBundle\Tests\Application;

use OpenDxp\Bundle\DataHubBundle\OpenDxpDataHubBundle;
use OpenDxp\HttpKernel\BundleCollection\BundleCollection;
use OpenDxp\TestFoundation\Kernel\TestKernel as Foundation;

final class TestKernel extends Foundation
{
    public function registerBundlesToCollection(BundleCollection $collection): void
    {
        $collection->addBundle(new OpenDxpDataHubBundle());
    }
}
