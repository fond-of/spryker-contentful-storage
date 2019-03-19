<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Plugin;

use FondOfSpryker\Zed\Contentful\Business\Client\Entry\ContentfulEntryInterface;
use FondOfSpryker\Zed\Contentful\Business\Storage\Entry\EntryInterface;

interface StorageWriterPluginInterface
{
    /**
     * @param \FondOfSpryker\Zed\Contentful\Business\Client\Entry\ContentfulEntryInterface $contentfulEntry
     * @param \FondOfSpryker\Zed\Contentful\Business\Storage\Entry\EntryInterface $entry
     * @param string $locale
     *
     * @return void
     */
    public function handle(ContentfulEntryInterface $contentfulEntry, EntryInterface $entry, string $locale): void;
}
