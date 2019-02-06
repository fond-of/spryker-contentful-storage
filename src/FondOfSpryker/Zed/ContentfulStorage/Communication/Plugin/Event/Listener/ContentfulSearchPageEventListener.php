<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Communication\Plugin\Event\Listener;

use FondOfSpryker\Zed\ContentfulStorage\Dependency\ContentfulStorageEvents;
use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\ContentfulStorage\Business\ContentfulStorageFacade getFacade()
 * @method \FondOfSpryker\Zed\ContentfulStorage\Communication\ContentfulStorageCommunicationFactory getFactory()
 */
class ContentfulSearchPageEventListener extends AbstractPlugin implements EventBulkHandlerInterface
{
    /**
     * Specification
     *  - Listeners needs to implement this interface to execute the codes for more
     *  than one event at same time (Bulk Operation)
     *
     * @api
     *
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface[] $transfers
     * @param string $eventName
     *
     * @return void
     */
    public function handleBulk(array $transfers, $eventName)
    {
        $eventTransferIds = $this->getFactory()->getEventBehaviourFacade()->getEventTransferIds($transfers);

        if ($eventName === ContentfulStorageEvents::ENTITY_FOS_CONTENTFUL_STORAGE_CREATE) {
        } elseif ($eventName === ContentfulStorageEvents::ENTITY_FOS_CONTENTFUL_STORAGE_UPDATE) {
        }
    }
}
