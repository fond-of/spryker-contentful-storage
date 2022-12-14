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
 * @method \FondOfSpryker\Zed\ContentfulStorage\ContentfulStorageConfig getConfig()
 * @method \FondOfSpryker\Zed\ContentfulStorage\Persistence\ContentfulStorageQueryContainerInterface getQueryContainer()
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
        $this->addContentfulCreateStorageListener($eventCollection);
        $this->addContentfulDeleteStorageListener($eventCollection);
        $this->addContentfulUpdateStorageListener($eventCollection);
        $this->addContentfulPublishStorageListener($eventCollection);

        return $eventCollection;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addContentfulCreateStorageListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(ContentfulEvents::ENTITY_FOS_CONTENTFUL_CREATE, new ContentfulStorageListener());
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addContentfulDeleteStorageListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(ContentfulEvents::ENTITY_FOS_CONTENTFUL_DELETE, new ContentfulStorageListener());
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addContentfulUpdateStorageListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(ContentfulEvents::ENTITY_FOS_CONTENTFUL_UPDATE, new ContentfulStorageListener());
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addContentfulPublishStorageListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(ContentfulEvents::CONTENTFUL_PUBLISH, new ContentfulStorageListener());
    }
}
