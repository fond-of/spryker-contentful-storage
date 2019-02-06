<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Communication\Plugin\Event\Subscriber;

use FondOfSpryker\Zed\ContentfulStorage\Communication\Plugin\Event\Listener\ContentfulSearchPageEventListener;
use FondOfSpryker\Zed\ContentfulStorage\Dependency\ContentfulStorageEvents;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\ContentfulStorage\Business\ContentfulStorageFacade getFacade()
 */
class ContentfulStorageEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
{
    /**
     * @api
     *
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection): EventCollectionInterface
    {
        $eventCollection->addListenerQueued(ContentfulStorageEvents::ENTITY_FOS_CONTENTFUL_STORAGE_CREATE, new ContentfulSearchPageEventListener());
        $eventCollection->addListenerQueued(ContentfulStorageEvents::ENTITY_FOS_CONTENTFUL_STORAGE_UPDATE, new ContentfulSearchPageEventListener());

        return $eventCollection;
    }
}
