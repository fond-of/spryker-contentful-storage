<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Communication\Plugin\Event\Listener;

use FondOfSpryker\Zed\Contentful\Dependency\ContentfulEvents;
use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\ContentfulStorage\Business\ContentfulStorageFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\ContentfulStorage\Communication\ContentfulStorageCommunicationFactory getFactory()
 */
class ContentfulStorageListener extends AbstractPlugin implements EventBulkHandlerInterface
{
     /**
      * @param array $transfers
      * @param string $eventName
      *
      * @return void
      */
    public function handleBulk(array $transfers, $eventName): void
    {
        $eventTransferIds = $this->getFactory()->getEventBehaviourFacade()->getEventTransferIds($transfers);

        if ($eventName === ContentfulEvents::ENTITY_FOS_CONTENTFUL_CREATE) {
            $this->getFacade()->publish($eventTransferIds);
        } elseif ($eventName === ContentfulEvents::ENTITY_FOS_CONTENTFUL_UPDATE) {
            $this->getFacade()->publish($eventTransferIds);
        }
    }
}
