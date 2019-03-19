<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Persistence;

use Orm\Zed\ContentfulStorage\Persistence\Base\FosContentfulStorageQuery;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \FondOfSpryker\Zed\ContentfulStorage\Persistence\ContentfulStoragePersistenceFactory getFactory()
 */
class ContentfulStorageQueryContainer extends AbstractQueryContainer implements ContentfulStorageQueryContainerInterface
{
    /**
     * @param array $contentfulEntryIds
     *
     * @return \Orm\Zed\ContentfulStorage\Persistence\Base\FosContentfulStorageQuery
     */
    public function queryContentfulStorageByIds(array $contentfulEntryIds): FosContentfulStorageQuery
    {
        return $this->getFactory()
            ->createFobContentfulStorageQuery()
            ->filterByFkContentful_In($contentfulEntryIds);
    }
}
