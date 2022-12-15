<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Dependency;

interface ContentfulStorageEvents
{
    /**
     * @var string
     */
    public const ENTITY_FOS_CONTENTFUL_STORAGE_CREATE = 'Entity.fos_contentful_storage.create';

    /**
     * @var string
     */
    public const ENTITY_FOS_CONTENTFUL_STORAGE_UPDATE = 'Entity.fos_contentful_storage.update';
}
