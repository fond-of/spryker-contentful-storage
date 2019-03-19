<?php

namespace FondOfSpryker\Zed\ContentfulStorage;

use FondOfSpryker\Shared\ContentfulStorage\ContentfulStorageConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ContentfulStorageConfig extends AbstractBundleConfig
{
    /**
     * @return string|null
     */
    public function getContentfulStorageSynchronizationPoolName(): ?string
    {
        return $this->get(
            ContentfulStorageConstants::CONTENTFUL_SYNC_STORAGE_SYNCHRONIZATION_POOL_NAME,
            ContentfulStorageConstants::CONTENTFUL_SYNC_STORAGE_DEFAULT_SYNCHRONIZATION_POOL_NAME
        );
    }
}
