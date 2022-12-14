<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Persistence;

use Orm\Zed\Contentful\Persistence\FosContentfulQuery;
use Orm\Zed\ContentfulStorage\Persistence\Base\FosContentfulStorageQuery;

interface ContentfulStorageQueryContainerInterface
{
    /**
     * @param array $contentfulEntryIds
     *
     * @return \Orm\Zed\Contentful\Persistence\FosContentfulQuery
     */
    public function queryContentfulEntriesByIds(array $contentfulEntryIds): FosContentfulQuery;

    /**
     * @param array $contentfulEntryIds
     *
     * @return \Orm\Zed\ContentfulStorage\Persistence\Base\FosContentfulStorageQuery
     */
    public function queryContentfulStorageByIds(array $contentfulEntryIds): FosContentfulStorageQuery;
}
