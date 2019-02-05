<?php

namespace FondOfSpryker\Service\ContentfulStorage;

use Orm\Zed\Contentful\Persistence\FosContentfulQuery;
use Spryker\Service\Kernel\AbstractServiceFactory;

class ContentfulStorageServiceFactory extends AbstractServiceFactory
{
    /**
     * @return \Orm\Zed\Contentful\Persistence\FosContentfulQuery
     */
    public function createFosContentfulQuery(): FosContentfulQuery
    {
        return FosContentfulQuery::create();
    }
}
