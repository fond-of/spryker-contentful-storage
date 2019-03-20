<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Entry;

use FondOfSpryker\Zed\ContentfulStorage\Business\Client\Entry\ContentfulEntryInterface;

interface EntryMapperInterface
{
    /**
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Client\Entry\ContentfulEntryInterface $contentfulEntry
     *
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Entry\EntryInterface
     */
    public function createEntry(ContentfulEntryInterface $contentfulEntry): EntryInterface;
}
