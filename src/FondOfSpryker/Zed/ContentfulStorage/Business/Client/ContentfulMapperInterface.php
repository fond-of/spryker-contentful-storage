<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business\Client;

use Contentful\Core\Resource\ResourceArray;
use Contentful\Delivery\Resource\Entry;
use FondOfSpryker\Zed\ContentfulStorage\Business\Client\Entry\ContentfulEntryCollectionInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Client\Entry\ContentfulEntryInterface;

interface ContentfulMapperInterface
{
    /**
     * @param \Contentful\Core\Resource\ResourceArray $resourceArray
     *
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Client\Entry\ContentfulEntryCollectionInterface
     */
    public function createContentfulEntries(ResourceArray $resourceArray): ContentfulEntryCollectionInterface;

    /**
     * @param \Contentful\Delivery\Resource\Entry $entry
     *
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Client\Entry\ContentfulEntryInterface
     */
    public function createContentfulEntry(Entry $entry): ContentfulEntryInterface;
}
