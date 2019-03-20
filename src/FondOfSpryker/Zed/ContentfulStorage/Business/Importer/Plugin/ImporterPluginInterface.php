<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business\Importer\Plugin;

use FondOfSpryker\Zed\ContentfulStorage\Business\Client\Entry\ContentfulEntryInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Entry\EntryInterface;

interface ImporterPluginInterface
{
    /**
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Client\Entry\ContentfulEntryInterface $contentfulEntry
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Entry\EntryInterface $entry
     * @param string $locale
     *
     * @return void
     */
    public function handle(ContentfulEntryInterface $contentfulEntry, EntryInterface $entry, string $locale): void;
}
