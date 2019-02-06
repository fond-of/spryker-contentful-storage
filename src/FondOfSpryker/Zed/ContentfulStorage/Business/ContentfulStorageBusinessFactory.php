<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business;

use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\ContentfulStorageWriter;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\ContentfulStorageWriterInterface;
use Orm\Zed\Contentful\Persistence\FosContentfulQuery;
use Orm\Zed\ContentfulStorage\Persistence\FosContentfulStorageQuery;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class ContentfulStorageBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\ContentfulStorage\Business\Storage\ContentfulStorageWriterInterface
     */
    public function createContentfulStorageWriter(): ContentfulStorageWriterInterface
    {
        return new ContentfulStorageWriter(
            $this->createFosContentfulQuery(),
            $this->createFosContentfulStorageQuery()
        );
    }

    /**
     * @return \Orm\Zed\Contentful\Persistence\FosContentfulQuery
     */
    protected function createFosContentfulQuery(): FosContentfulQuery
    {
        return FosContentfulQuery::create();
    }

    /**
     * @return \Orm\Zed\ContentfulStorage\Persistence\FosContentfulStorageQuery
     */
    protected function createFosContentfulStorageQuery(): FosContentfulStorageQuery
    {
        return FosContentfulStorageQuery::create();
    }
}
