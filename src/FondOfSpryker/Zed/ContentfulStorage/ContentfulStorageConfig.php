<?php

namespace FondOfSpryker\Zed\ContentfulStorage;

use FondOfSpryker\Shared\ContentfulStorage\ContentfulStorageConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ContentfulStorageConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const DEFAULT_FIELD_NAME_ACTIVE = 'isActive';

    /**
     * @var string
     */
    public const DEFAULT_FIELD_NAME_IDENTIFIER = 'identifier';

    /**
     * @return string|null
     */
    public function getContentfulStorageSynchronizationPoolName(): ?string
    {
        return $this->get(
            ContentfulStorageConstants::CONTENTFUL_SYNC_STORAGE_SYNCHRONIZATION_POOL_NAME,
            ContentfulStorageConstants::CONTENTFUL_SYNC_STORAGE_DEFAULT_SYNCHRONIZATION_POOL_NAME,
        );
    }

    /**
     * @return string
     */
    public function getSpaceId(): string
    {
        return $this->get(ContentfulStorageConstants::CONTENTFUL_SPACE_ID);
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->get(ContentfulStorageConstants::CONTENTFUL_ACCESS_TOKEN);
    }

    /**
     * @return string
     */
    public function getDefaultLocale(): string
    {
        return $this->get(ContentfulStorageConstants::CONTENTFUL_DEFAULT_LOCALE);
    }

    /**
     * @return string
     */
    public function getFieldNameActive(): string
    {
        return $this->getConfig()->get(ContentfulStorageConstants::CONTENTFUL_FIELD_NAME_ACTIVE, static::DEFAULT_FIELD_NAME_ACTIVE);
    }

    /**
     * @return string
     */
    public function getFieldNameIdentifier(): string
    {
        return $this->getConfig()->get(ContentfulStorageConstants::CONTENTFUL_FIELD_NAME_IDENTIFIER, static::DEFAULT_FIELD_NAME_IDENTIFIER);
    }

    /**
     * @return array
     */
    public function getLocaleMapping(): array
    {
        return $this->get(ContentfulStorageConstants::CONTENTFUL_LOCALE_TO_STORE_LOCALE);
    }
}
