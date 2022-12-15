<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business;

use FondOfSpryker\Shared\Contentful\Url\UrlFormatter;
use FondOfSpryker\Shared\Contentful\Url\UrlFormatterInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\ContentfulStorageWriter;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\ContentfulStorageWriterInterface;
use FondOfSpryker\Zed\ContentfulStorage\ContentfulStorageDependencyProvider;
use FondOfSpryker\Zed\ContentfulStorage\Dependency\Facade\ContentfulStorageToContentfulPageSearchFacadeInterface;
use Orm\Zed\Contentful\Persistence\FosContentfulQuery;
use Orm\Zed\ContentfulStorage\Persistence\FosContentfulStorageQuery;
use Spryker\Client\Storage\StorageClientInterface;
use Spryker\Client\Store\StoreClientInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\ContentfulStorage\ContentfulStorageConfig getConfig()
 * @method \FondOfSpryker\Zed\ContentfulStorage\Business\ContentfulStorageQueryContainer getQueryContainer()
 */
class ContentfulStorageBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\ContentfulStorageWriterInterface
     */
    public function createContentfulStorageWriter(): ContentfulStorageWriterInterface
    {
        return new ContentfulStorageWriter(
            $this->getFosContentfulQuery(),
            $this->getFosContentfulStorageQuery(),
        );
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

    /**
     * @return \Spryker\Client\Storage\StorageClientInterface
     */
    protected function getStorageClient(): StorageClientInterface
    {
        return $this->getProvidedDependency(ContentfulStorageDependencyProvider::STORAGE_CLIENT);
    }

    /**
     * @return \FondOfSpryker\Shared\Contentful\Url\UrlFormatterInterface
     */
    protected function createUrlFormatter(): UrlFormatterInterface
    {
        return new UrlFormatter($this->getStoreClient());
    }

    /**
     * @return \Orm\Zed\ContentfulStorage\Persistence\FosContentfulStorageQuery
     */
    protected function getFosContentfulStorageQuery(): FosContentfulStorageQuery
    {
        return FosContentfulStorageQuery::create();
    }

    /**
     * @return \Orm\Zed\Contentful\Persistence\FosContentfulQuery
     */
    protected function getFosContentfulQuery(): FosContentfulQuery
    {
        return FosContentfulQuery::create();
    }
}
