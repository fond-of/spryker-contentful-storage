<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\ContentfulStorage\Business\ContentfulStorageBusinessFactory getFactory()
 */
class ContentfulStorageFacade extends AbstractFacade implements ContentfulStorageFacadeInterface
{
    /**
     * @param array $contentfulEntryIds
     *
     * @return void
     */
    public function publish(array $contentfulEntryIds): void
    {
        $this->getFactory()->createContentfulStorageWriter()->publish($contentfulEntryIds);
    }

    /**
     * @param array $contentfulEntryIds
     *
     * @return void
     */
    public function update(array $contentfulEntryIds): void
    {
        $this->getFactory()->createContentfulStorageWriter()->update($contentfulEntryIds);
    }

    /**
     * @param array $contentfulEntryIds
     *
     * @return void
     */
    public function unpublish(array $contentfulEntryIds): void
    {
        // TODO: Implement unpublish() method.
    }

    /**
     * @return int
     */
    public function importLastChangedEntries(): int
    {
        return $this->getFactory()->createImporter()->importLastChangedEntries();
    }

    /**
     * @return int
     */
    public function importAllEntries(): int
    {
        return $this->getFactory()->createImporter()->importAllEntries();
    }

    /**
     * @param string $entryId
     *
     * @return int
     */
    public function importEntry(string $entryId): int
    {
        return $this->getFactory()->createImporter()->importEntry();
    }
}
