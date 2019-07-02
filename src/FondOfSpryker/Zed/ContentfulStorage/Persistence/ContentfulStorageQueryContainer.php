<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Persistence;

use Orm\Zed\Contentful\Persistence\FosContentfulQuery;
use Orm\Zed\ContentfulStorage\Persistence\Base\FosContentfulStorageQuery;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \FondOfSpryker\Zed\ContentfulStorage\Persistence\ContentfulStoragePersistenceFactory getFactory()
 */
class ContentfulStorageQueryContainer extends AbstractQueryContainer implements ContentfulStorageQueryContainerInterface
{
    /**
     * @param array $contentfulEntryIds
     *
     * @return \Orm\Zed\Contentful\Persistence\FosContentfulQuery
     */
    public function queryContentfulEntriesByIds(array $contentfulEntryIds): FosContentfulQuery
    {
        return $this
            ->getFactory()
            ->createFosContentfulQuery()
            ->filterByIdContentful_In($contentfulEntryIds)
            ->setFormatter(ModelCriteria::FORMAT_ARRAY);
    }

    /**
     * @param array $contentfulEntryIds
     *
     * @return \Orm\Zed\ContentfulStorage\Persistence\Base\FosContentfulStorageQuery
     */
    public function queryContentfulStorageByIds(array $contentfulEntryIds): FosContentfulStorageQuery
    {
        return $this->getFactory()
            ->createFosContentfulStorageQuery()
            ->filterByFkContentful_In($contentfulEntryIds)
            ->setFormatter(ModelCriteria::FORMAT_ARRAY);
    }
}
