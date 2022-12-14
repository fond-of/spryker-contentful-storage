<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Communication;

use FondOfSpryker\Zed\ContentfulStorage\ContentfulStorageDependencyProvider;
use FondOfSpryker\Zed\ContentfulStorage\Dependency\Facade\ContentfulStorageToEventBehaviorFacadeInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \FondOfSpryker\Zed\ContentfulStorage\ContentfulStorageConfig getConfig()
 * @method \FondOfSpryker\Zed\ContentfulStorage\Persistence\ContentfulStorageQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\ContentfulStorage\Business\ContentfulStorageFacadeInterface getFacade()
 */
class ContentfulStorageCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Dependency\Facade\ContentfulStorageToEventBehaviorFacadeInterface
     */
    public function getEventBehaviourFacade(): ContentfulStorageToEventBehaviorFacadeInterface
    {
        return $this->getProvidedDependency(ContentfulStorageDependencyProvider::FACADE_EVENT_BEHAVIOUR);
    }
}
