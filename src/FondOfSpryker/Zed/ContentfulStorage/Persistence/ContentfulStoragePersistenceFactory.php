<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Persistence;

use Orm\Zed\ContentfulStorage\Persistence\Base\FosContentfulStorageQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\ContentfulStorage\Persistence\ContentfulStorageQueryContainer getQueryContainer()
 */
class ContentfulStoragePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ContentfulStorage\Persistence\Base\FosContentfulStorageQuery
     */
    public function createFobContentfulStorageQuery(): FosContentfulStorageQuery
    {
        return FosContentfulStorageQuery::create();
    }
}
