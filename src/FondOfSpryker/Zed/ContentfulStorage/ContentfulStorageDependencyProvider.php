<?php

namespace FondOfSpryker\Zed\ContentfulStorage;

use FondOfSpryker\Zed\ContentfulStorage\Dependency\Facade\ContentfulStorageToEventBehaviorFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ContentfulStorageDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_EVENT_BEHAVIOUR = 'FACADE_EVENT_BEHAVIOUR';

    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = $this->addEventBehaviourFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addEventBehaviourFacade(Container $container): Container
    {
        $container[self::FACADE_EVENT_BEHAVIOUR] = function (Container $container) {
            return new ContentfulStorageToEventBehaviorFacadeBridge(
                $container->getLocator()->eventBehavior()->facade()
            );
        };

        return $container;
    }
}
