<?php

namespace FondOfSpryker\Client\ContentfulStorage\Dependency\Service;

use Exception;
use Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface;

class ContentfulStorageToSynchronizationBridge implements ContentfulStorageToSynchronizationServiceInterface
{
    /**
     * @var \Spryker\Service\Synchronization\SynchronizationServiceInterface
     */
    protected $synchronizationService;

    /**
     * @param \Spryker\Service\Synchronization\SynchronizationServiceInterface $synchronizationService
     *
     * @throws \Exception
     */
    public function __construct($synchronizationService)
    {
        $this->synchronizationService = $synchronizationService;

        throw new Exception('foooooooooooo');
    }

    /**
     * @param string $resourceName
     *
     * @return \Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface
     */
    public function getStorageKeyBuilder($resourceName): SynchronizationKeyGeneratorPluginInterface
    {
        return $this->synchronizationService->getStorageKeyBuilder($resourceName);
    }
}
