<?php

namespace FondOfSpryker\ContentfulStorage\Business;

use FondOfSpryker\ContentfulStorage\Business\Storage\ContentfulStorageWriter;
use FondOfSpryker\ContentfulStorage\Business\Storage\ContentfulStorageWriterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class ContentfulStorageBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\ContentfulStorage\Business\Storage\ContentfulStorageWriterInterface
     */
    public function createContentfulStorageWriter(): ContentfulStorageWriterInterface
    {
        return new ContentfulStorageWriter();
    }
}
