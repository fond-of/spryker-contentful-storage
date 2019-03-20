<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business\Importer\Plugin\Storage;

use FondOfSpryker\Zed\ContentfulStorage\Business\Client\Entry\ContentfulEntryInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Entry\EntryInterface;

class EntryStorageImporterPlugin extends AbstractStorageImporterPlugin
{
    /**
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Client\Entry\ContentfulEntryInterface $contentfulEntry
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Entry\EntryInterface $entry
     * @param string $locale
     *
     * @throws
     *
     * @return string
     */
    protected function createStorageKey(ContentfulEntryInterface $contentfulEntry, EntryInterface $entry, string $locale): string
    {
        return $this->keyBuilder->generateKey($entry->getId(), $locale);
    }

    /**
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Client\Entry\ContentfulEntryInterface $contentfulEntry
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Entry\EntryInterface $entry
     * @param string $locale
     *
     * @throws
     *
     * @return string[]
     */
    protected function createStorageValue(ContentfulEntryInterface $contentfulEntry, EntryInterface $entry, string $locale): array
    {
        return $entry->jsonSerialize();
    }
}
