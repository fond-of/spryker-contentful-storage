<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business;

interface ContentfulStorageFacadeInterface
{
    /**
     * @param array $contentfulEntryIds
     *
     * @return void
     */
    public function publish(array $contentfulEntryIds): void;

    /**
     * @param array $contentfulEntryIds
     *
     * @return void
     */
    public function update(array $contentfulEntryIds): void;

    /**
     * @param array $contentfulEntryIds
     *
     * @return void
     */
    public function unpublish(array $contentfulEntryIds): void;

    /**
     * @return int
     */
    public function importLastChangedEntries(): int;

    /**
     * @return int
     */
    public function importAllEntries(): int;

    /**
     * @param string $entryId
     *
     * @return int
     */
    public function importEntry(string $entryId): int;
}
