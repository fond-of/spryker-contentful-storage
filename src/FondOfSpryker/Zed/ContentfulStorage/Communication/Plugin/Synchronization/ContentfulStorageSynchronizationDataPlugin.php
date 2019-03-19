<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Communication\Plugin\Synchronization;

use FondOfSpryker\Shared\ContentfulStorage\ContentfulStorageConstants;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SynchronizationExtension\Dependency\Plugin\SynchronizationDataQueryContainerPluginInterface;

/**
 * @method \FondOfSpryker\Zed\ContentfulStorage\Business\ContentfulStorageFacade getFacade()
 * @method \FondOfSpryker\Zed\ContentfulStorage\Communication\ContentfulStorageCommunicationFactory getFactory()
 * @method \FondOfSpryker\Zed\ContentfulStorage\Persistence\ContentfulStorageQueryContainer getQueryContainer()
 * @method \FondOfSpryker\Zed\ContentfulStorage\ContentfulStorageConfig getConfig()
 */
class ContentfulStorageSynchronizationDataPlugin extends AbstractPlugin implements SynchronizationDataQueryContainerPluginInterface
{
    /**
     * Specification:
     *  - Returns the resource name of the storage or search module
     *
     * @api
     *
     * @return string
     */
    public function getResourceName(): string
    {
        return 'contentful';
    }

    /**
     * Specification:
     *  - Returns true if this entity has multi-store concept
     *
     * @api
     *
     * @return bool
     */
    public function hasStore(): bool
    {
        return false;
    }

    /**
     * Specification:
     *  - Returns array of configuration parameter which needed for Redis or Elasticsearch
     *
     * @api
     *
     * @return array
     */
    public function getParams(): array
    {
        return [];
    }

    /**
     * Specification:
     *  - Returns synchronization queue name
     *
     * @api
     *
     * @return string
     */
    public function getQueueName(): string
    {
        return ContentfulStorageConstants::CONTENTFUL_SYNC_STORAGE_QUEUE;
    }

    /**
     * Specification:
     *  - Returns synchronization queue pool name for broadcasting messages
     *
     * @api
     *
     * @return string|null
     */
    public function getSynchronizationQueuePoolName(): ?string
    {
        return $this->getConfig()->getContentfulStorageSynchronizationPoolName();
    }

    /**
     * Specification:
     *  - Returns query of storage or search entity, provided $ids parameter
     *    will apply to query to limit the result
     *
     * @api
     *
     * @param int[] $ids
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria|null
     */
    public function queryData($ids = []): ?ModelCriteria
    {
        $query = $this->getQueryContainer()
            ->queryContentfulStorageByIds($ids);

        if (empty($ids)) {
            $query->clear();
        }

        return $query;
    }
}
