<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business;

use Exception;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\ContentfulStorage\Business\ContentfulStorageBusinessFactory getFactory()
 */
class ContentfulStorageFacade extends AbstractFacade implements ContentfulStorageFacadeInterface
{
    /**
     * @param array $contentfulEntryIds
     *
     * @throws \Exception
     *
     * @return void
     */
    public function publish(array $contentfulEntryIds): void
    {
        throw new Exception('ContentfulStorageFacade->publish() calles');
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
}
