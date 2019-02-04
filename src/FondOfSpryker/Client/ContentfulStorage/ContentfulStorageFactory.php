<?php

namespace FondOfSpryker\Client\ContentfulStorage;

use FondOfSpryker\Client\ContentfulStorage\Dependency\Service\ContentfulStorageToSynchronizationServiceInterface;
use Spryker\Client\Kernel\AbstractFactory;

class ContentfulStorageFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Client\ContentfulStorage\Dependency\Service\ContentfulStorageToSynchronizationServiceInterface
     */
    public function getSynchronizationService(): ContentfulStorageToSynchronizationServiceInterface
    {
        return $this->getProvidedDependency(ContentfulStorageDependencyProvider::SERVICE_SYNCHRONIZATION);
    }
}
