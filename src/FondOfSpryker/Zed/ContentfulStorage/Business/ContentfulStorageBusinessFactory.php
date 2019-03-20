<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business;

use Contentful\Delivery\Client;
use FondOfSpryker\Shared\Contentful\KeyBuilder\EntryKeyBuilder;
use FondOfSpryker\Shared\Contentful\Url\UrlFormatter;
use FondOfSpryker\Shared\Contentful\Url\UrlFormatterInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Client\ContentfulAPIClient;
use FondOfSpryker\Zed\ContentfulStorage\Business\Client\ContentfulAPIClientInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Client\ContentfulMapper;
use FondOfSpryker\Zed\ContentfulStorage\Business\Client\ContentfulMapperInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Importer\Importer;
use FondOfSpryker\Zed\ContentfulStorage\Business\Importer\ImporterInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Importer\Plugin\ImporterPluginInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Importer\Plugin\Storage\EntryStorageImporterPlugin;
use FondOfSpryker\Zed\ContentfulStorage\Business\Importer\Plugin\Storage\IdentifierStorageImporterPlugin;
use FondOfSpryker\Zed\ContentfulStorage\Business\KeyBuilder\IdentifierKeyBuilder;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Asset\AssetFieldMapper;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Boolean\BooleanFieldMapper;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Collection\CollectionFieldMapper;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\ContentfulStorageWriter;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\ContentfulStorageWriterInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Entry\EntryMapper;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Entry\EntryMapperInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\CustomFieldMapperCollection;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\CustomFieldMapperCollectionInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\DefaultFieldMapper;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\FieldMapperLocator;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\FieldMapperLocatorInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\TypeFieldMapperCollection;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\TypeFieldMapperCollectionInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\TypeFieldMapperInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Link\LinkFieldMapper;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Object\ObjectFieldMapper;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Plugin\IdentifierStorageWriterPlugin;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Plugin\StorageWriterPluginInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Reference\ReferenceFieldMapper;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Text\TextFieldMapper;
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
            $this->createFosContentfulStorageQuery()
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
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Importer\ImporterInterface
     */
    public function createImporter(): ImporterInterface
    {
        return new Importer(
            $this->createContentfulAPIClient(),
            $this->createContentfulMapper(),
            $this->createEntryMapper(),
            $this->getImporterPlugins(),
            $this->getConfig()->getLocaleMapping()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\FieldMapperLocatorInterface
     */
    public function createFieldMapperLocator(): FieldMapperLocatorInterface
    {
        return new FieldMapperLocator(
            $this->createDefaultFieldMapper(),
            $this->createTypeFieldMapperCollection(),
            $this->createCustomFieldMapperCollection()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\CustomFieldMapperCollectionInterface
     */
    public function createCustomFieldMapperCollection(): CustomFieldMapperCollectionInterface
    {
        return new CustomFieldMapperCollection();
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\TypeFieldMapperCollectionInterface
     */
    public function createTypeFieldMapperCollection(): TypeFieldMapperCollectionInterface
    {
        $collection = new TypeFieldMapperCollection();
        $collection->add($this->createAssetFieldMapper());
        $collection->add($this->createBooleanFieldMapper());
        $collection->add($this->createCollectionFieldMapper());
        $collection->add($this->createReferenceFieldMapper());
        $collection->add($this->createLinkFieldMapper());
        $collection->add($this->createTextFieldMapper());
        $collection->add($this->createObjectFieldMapper());

        return $collection;
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Importer\Plugin\ImporterPluginInterface
     */
    protected function createIdentifierImporterPlugin(): ImporterPluginInterface
    {
        return new IdentifierStorageImporterPlugin(
            $this->createIdentifierKeyBuilder(),
            $this->getStorageClient(),
            $this->createUrlFormatter(),
            $this->getConfig()->getFieldNameActive(),
            $this->getConfig()->getFieldNameIdentifier(),
            $this->createFosContentfulQuery()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Client\ContentfulAPIClientInterface
     */
    protected function createContentfulAPIClient(): ContentfulAPIClientInterface
    {
        return new ContentfulAPIClient($this->createContentfulClient());
    }

    /**
     * @return \Contentful\Delivery\Client
     */
    protected function createContentfulClient(): Client
    {
        return new Client(
            $this->getConfig()->getAccessToken(),
            $this->getConfig()->getSpaceId(),
            'master',
            false,
            $this->getConfig()->getDefaultLocale()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Client\ContentfulMapperInterface
     */
    protected function createContentfulMapper(): ContentfulMapperInterface
    {
        return new ContentfulMapper(
            $this->getConfig()->getDefaultLocale(),
            $this->createContentfulAPIClient()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Entry\EntryMapperInterface
     */
    protected function createEntryMapper(): EntryMapperInterface
    {
        return new EntryMapper($this->createFieldMapperLocator());
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Importer\Plugin\ImporterPluginInterface[]
     */
    protected function getImporterPlugins(): array
    {
        return [
            $this->createEntryStorageImporterPlugin(),
            $this->createIdentifierImporterPlugin(),
        ];
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Importer\Plugin\ImporterPluginInterface
     */
    protected function createEntryStorageImporterPlugin(): ImporterPluginInterface
    {
        return new EntryStorageImporterPlugin(
            $this->createEntryKeyBuilder(),
            $this->getStorageClient(),
            $this->getConfig()->getFieldNameActive(),
            $this->createFosContentfulQuery()
        );
    }

    /**
     * @return \Spryker\Shared\KeyBuilder\KeyBuilderInterface
     */
    protected function createEntryKeyBuilder(): KeyBuilderInterface
    {
        return new EntryKeyBuilder();
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\TypeFieldMapperInterface
     */
    protected function createDefaultFieldMapper(): TypeFieldMapperInterface
    {
        return new DefaultFieldMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\TypeFieldMapperInterface
     */
    protected function createAssetFieldMapper(): TypeFieldMapperInterface
    {
        return new AssetFieldMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\TypeFieldMapperInterface
     */
    protected function createBooleanFieldMapper(): TypeFieldMapperInterface
    {
        return new BooleanFieldMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\TypeFieldMapperInterface
     */
    protected function createCollectionFieldMapper(): TypeFieldMapperInterface
    {
        return new CollectionFieldMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\TypeFieldMapperInterface
     */
    protected function createReferenceFieldMapper(): TypeFieldMapperInterface
    {
        return new ReferenceFieldMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\TypeFieldMapperInterface
     */
    protected function createLinkFieldMapper(): TypeFieldMapperInterface
    {
        return new LinkFieldMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\TypeFieldMapperInterface
     */
    protected function createTextFieldMapper(): TypeFieldMapperInterface
    {
        return new TextFieldMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\TypeFieldMapperInterface
     */
    protected function createObjectFieldMapper(): TypeFieldMapperInterface
    {
        return new ObjectFieldMapper();
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
            $this->createUrlFormatter()
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
     * @return \FondOfSpryker\Shared\Contentful\Url\UrlFormatterInterface
     */
    protected function createUrlFormatter(): UrlFormatterInterface
    {
        return new UrlFormatter($this->getStoreClient());
    }

    /**
     * @return \Orm\Zed\ContentfulStorage\Persistence\FosContentfulStorageQuery
     */
    protected function createFosContentfulStorageQuery(): FosContentfulStorageQuery
    {
        return FosContentfulStorageQuery::create();
    }

    /**
     * @return \Orm\Zed\Contentful\Persistence\FosContentfulQuery
     */
    protected function createFosContentfulQuery(): FosContentfulQuery
    {
        return FosContentfulQuery::create();
    }
}
