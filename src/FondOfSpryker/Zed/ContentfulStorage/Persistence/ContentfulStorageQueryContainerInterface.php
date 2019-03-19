<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Persistence;

use Orm\Zed\ContentfulStorage\Persistence\Base\FosContentfulStorageQuery;

interface ContentfulStorageQueryContainerInterface
{
    /**
     * @param array $contentfulEntryIds
     *
     * @return \Orm\Zed\ContentfulStorage\Persistence\Base\FosContentfulStorageQuery
     */
    public function queryContentfulStorageByIds(array $contentfulEntryIds): FosContentfulStorageQuery;
}
