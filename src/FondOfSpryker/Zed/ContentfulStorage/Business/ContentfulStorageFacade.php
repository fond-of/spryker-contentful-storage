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
    public function unpublish(array $contentfulEntryIds): void
    {
        $this->getFactory()->createContentfulStorageWriter()->unpublish($contentfulEntryIds);
    }
}
