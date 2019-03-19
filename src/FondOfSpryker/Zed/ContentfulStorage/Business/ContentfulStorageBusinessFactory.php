<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business;

use FondOfSpryker\Zed\ContentfulStorage\Business\KeyBuilder\IdentifierKeyBuilder;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\ContentfulStorageWriter;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\ContentfulStorageWriterInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Plugin\IdentifierStorageWriterPlugin;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Plugin\StorageWriterPluginInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Url\UrlFormatter;
use FondOfSpryker\Zed\ContentfulStorage\Business\Url\UrlFormatterInterface;
use FondOfSpryker\Zed\ContentfulStorage\ContentfulStorageDependencyProvider;
use FondOfSpryker\Zed\ContentfulStorage\Dependency\Facade\ContentfulStorageToContentfulPageSearchFacadeInterface;
use Orm\Zed\Contentful\Persistence\FosContentfulQuery;
use Orm\Zed\ContentfulStorage\Persistence\FosContentfulStorageQuery;
use Spryker\Client\Storage\StorageClientInterface;
use Spryker\Client\Store\StoreClientInterface;
use Spryker\Shared\KeyBuilder\KeyBuilderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\ContentfulStorage\ContentfulStorageConfig getConfig()
 * @method ContentfulStorageQueryContainer getQueryContainer()
 */
class ContentfulStorageBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\ContentfulStorage\Business\Storage\ContentfulStorageWriterInterface
     */
    public function createContentfulStorageWriter(): ContentfulStorageWriterInterface
    {
        return new ContentfulStorageWriter(
            $this->createFosContentfulQuery(),
            $this->createFosContentfulStorageQuery(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Plugin\StorageWriterPluginInterface[]
     */
    protected function getStorageWriterPlugins(): array
    {
        return [
            $this->createIdentifierStorageWriterPlugin(),
        ];
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Plugin\StorageWriterPluginInterface
     */
    protected function createIdentifierStorageWriterPlugin(): StorageWriterPluginInterface
    {
        return new IdentifierStorageWriterPlugin(
            $this->createIdentifierKeyBuilder(),
            $this->getStorageClient(),
            $this->createUrlFormatter(),
        );
    }

    /**
     * @return \Spryker\Shared\KeyBuilder\KeyBuilderInterface
     */
    protected function createIdentifierKeyBuilder(): KeyBuilderInterface
    {
        return new IdentifierKeyBuilder();
    }

    /**
     * @return \Spryker\Client\Storage\StorageClientInterface
     */
    protected function getStorageClient(): StorageClientInterface
    {
        return $this->getProvidedDependency(ContentfulStorageDependencyProvider::STORAGE_CLIENT);
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Url\UrlFormatterInterface
     */
    protected function createUrlFormatter(): UrlFormatterInterface
    {
        return new UrlFormatter($this->getStoreClient());
    }

    /**
     * @return \Orm\Zed\Contentful\Persistence\FosContentfulQuery
     */
    protected function createFosContentfulQuery(): FosContentfulQuery
    {
        return FosContentfulQuery::create();
    }

    /**
     * @return \Orm\Zed\ContentfulStorage\Persistence\FosContentfulStorageQuery
     */
    protected function createFosContentfulStorageQuery(): FosContentfulStorageQuery
    {
        return FosContentfulStorageQuery::create();
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Dependency\Facade\ContentfulStorageToContentfulPageSearchFacadeInterface
     */
    public function getContentfulPageSearchFacade(): ContentfulStorageToContentfulPageSearchFacadeInterface
    {
        return $this->getProvidedDependency(ContentfulStorageDependencyProvider::FACADE_CONTENTFUL_PAGE_SEARCH);
    }

    /**
     * @return \Spryker\Client\Store\StoreClientInterface
     */
    public function getStoreClient(): StoreClientInterface
    {
        return $this->getProvidedDependency(ContentfulStorageDependencyProvider::CLIENT_STORE);
    }
}
