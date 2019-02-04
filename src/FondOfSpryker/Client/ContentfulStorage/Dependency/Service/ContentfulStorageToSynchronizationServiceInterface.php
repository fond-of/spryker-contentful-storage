<?php

namespace FondOfSpryker\Client\ContentfulStorage\Dependency\Service;

use Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface;

interface ContentfulStorageToSynchronizationServiceInterface
{
    /**
     * @param string $resourceName
     *
     * @return \Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface
     */
    public function getStorageKeyBuilder($resourceName): SynchronizationKeyGeneratorPluginInterface;
}
