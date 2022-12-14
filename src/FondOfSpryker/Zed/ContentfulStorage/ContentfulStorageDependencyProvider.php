<?php

namespace FondOfSpryker\Zed\ContentfulStorage;

use FondOfSpryker\Zed\ContentfulStorage\Dependency\Facade\ContentfulStorageToContentfulPageSearchFacadeBridge;
use FondOfSpryker\Zed\ContentfulStorage\Dependency\Facade\ContentfulStorageToEventBehaviorFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ContentfulStorageDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_EVENT_BEHAVIOUR = 'FACADE_EVENT_BEHAVIOUR';
    public const FACADE_CONTENTFUL_PAGE_SEARCH = 'FACADE_CONTENTFUL_PAGE_SEARCH';
    public const STORAGE_CLIENT = 'STORAGE_CLIENT';
    public const CLIENT_STORE = 'CLIENT_STORE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = $this->addEventBehaviourFacade($container);
        $container = $this->addContentfulPageSearchFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->addStorageClient($container);
        $container = $this->addStoreClient($container);

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

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStorageClient(Container $container): Container
    {
        $container[self::STORAGE_CLIENT] = function (Container $container) {
            return $container->getLocator()->storage()->client();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addContentfulPageSearchFacade(Container $container): Container
    {
        $container[static::FACADE_CONTENTFUL_PAGE_SEARCH] = function (Container $container) {
            return new ContentfulStorageToContentfulPageSearchFacadeBridge(
                $container->getLocator()->contentfulPageSearch()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStoreClient(Container $container): Container
    {
        $container[static::CLIENT_STORE] = function (Container $container) {
            return $container->getLocator()->store()->client();
        };

        return $container;
    }
}
