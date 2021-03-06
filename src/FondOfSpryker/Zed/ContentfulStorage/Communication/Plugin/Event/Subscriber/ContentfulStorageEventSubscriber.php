<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Communication\Plugin\Event\Subscriber;

use FondOfSpryker\Zed\Contentful\Dependency\ContentfulEvents;
use FondOfSpryker\Zed\ContentfulStorage\Communication\Plugin\Event\Listener\ContentfulStorageListener;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\Contentful\Business\ContentfulFacade getFacade()
 * @method \FondOfSpryker\Zed\Contentful\Communication\ContentfulCommunicationFactory getFactory()
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
        $eventCollection->addListenerQueued(ContentfulEvents::ENTITY_FOS_CONTENTFUL_CREATE, new ContentfulStorageListener());
        $eventCollection->addListenerQueued(ContentfulEvents::ENTITY_FOS_CONTENTFUL_UPDATE, new ContentfulStorageListener());

        return $eventCollection;
    }
}
