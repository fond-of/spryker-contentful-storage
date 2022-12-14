<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Communication\Plugin\Event;

use FondOfSpryker\Shared\ContentfulStorage\ContentfulStorageConstants;
use FondOfSpryker\Zed\Contentful\Dependency\ContentfulEvents;
use Orm\Zed\Contentful\Persistence\Map\FosContentfulTableMap;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\EventBehavior\Dependency\Plugin\EventResourceQueryContainerPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method ContentfulStorageFacade getFacade()
 * @method \FondOfSpryker\Zed\ContentfulStorage\Persistence\ContentfulStorageQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\ContentfulStorage\Communication\ContentfulStorageCommunicationFactory getFactory()
 * @method \FondOfSpryker\Zed\ContentfulStorage\ContentfulStorageConfig getConfig()
 */
class ContentfulResourceQueryContainerPlugin extends AbstractPlugin implements EventResourceQueryContainerPluginInterface
{
    /**
     * Specification:
     *  - Returns the name of resource
     *
     * @api
     *
     * @return string
     */
    public function getResourceName(): string
    {
        return ContentfulStorageConstants::CONTENTFUL_RESOURCE_NAME;
    }

    /**
     * Specification:
     *  - Returns the event name of resource entity
     *
     * @api
     *
     * @return string
     */
    public function getEventName(): string
    {
        return ContentfulEvents::CONTENTFUL_PUBLISH;
    }

    /**
     * Specification:
     *  - Returns the name of ID column for publishing
     *
     * @api
     *
     * @return string|null
     */
    public function getIdColumnName(): ?string
    {
        return FosContentfulTableMap::COL_ID_CONTENTFUL;
    }

    /**
     * Specification:
     *  - Returns query of resource entity, provided $ids parameter
     *    will apply to query to limit the result
     *
     * @api
     *
     * @param int[] $ids
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria|null
     */
    public function queryData(array $ids = []): ?ModelCriteria
    {
        $query = $this->getQueryContainer()->queryContentfulEntriesByIds($ids);

        if (empty($ids)) {
            $query->clear();
        }

        return $query;
    }
}
