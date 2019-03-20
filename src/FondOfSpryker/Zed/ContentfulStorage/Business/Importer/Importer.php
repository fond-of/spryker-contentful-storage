<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business\Importer;

use Contentful\Core\Resource\ResourceArray;
use Contentful\Delivery\Resource\Entry;
use FondOfSpryker\Zed\ContentfulStorage\Business\Client\ContentfulAPIClientInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Client\ContentfulMapperInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Client\Entry\ContentfulEntryInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Entry\EntryInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Entry\EntryMapperInterface;

class Importer implements ImporterInterface
{
    /**
     * @var \FondOfSpryker\Zed\ContentfulStorage\Business\Client\ContentfulAPIClientInterface
     */
    protected $contentfulAPIClient;

    /**
     * @var \FondOfSpryker\Zed\ContentfulStorage\Business\Client\ContentfulMapperInterface
     */
    protected $contentfulMapper;

    /**
     * @var \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Entry\EntryMapperInterface
     */
    protected $entryMapper;

    /**
     * @var \FondOfSpryker\Zed\ContentfulStorage\Business\Importer\Plugin\ImporterPluginInterface[]
     */
    protected $importerPlugins;

    /**
     * @var string[]
     */
    protected $localeMapping;

    /**
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Client\ContentfulAPIClientInterface $contentfulAPIClient
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Client\ContentfulMapperInterface $contentfulMapper
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Entry\EntryMapperInterface $entryMapper
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Importer\Plugin\ImporterPluginInterface[] $importerPlugins
     * @param string[] $localeMapping
     */
    public function __construct(ContentfulAPIClientInterface $contentfulAPIClient, ContentfulMapperInterface $contentfulMapper, EntryMapperInterface $entryMapper, array $importerPlugins, array $localeMapping)
    {
        $this->contentfulAPIClient = $contentfulAPIClient;
        $this->contentfulMapper = $contentfulMapper;
        $this->entryMapper = $entryMapper;
        $this->importerPlugins = $importerPlugins;
        $this->localeMapping = $localeMapping;
    }

    /**
     * @return int
     */
    public function importLastChangedEntries(): int
    {
        $resourceArray = $this->contentfulAPIClient->findLastChangedEntries();
        $this->importResource($resourceArray);
        return $resourceArray->getTotal();
    }

    /**
     * @return int
     */
    public function importAllEntries(): int
    {
        $resourceArray = $this->contentfulAPIClient->findAllEntries();
        $this->importResource($resourceArray);
        return $resourceArray->getTotal();
    }

    /**
     * @param string $entryId
     *
     * @return int
     */
    public function importEntry(string $entryId): int
    {
        $resourceArray = $this->contentfulAPIClient->findEntryById($entryId);
        $this->importResource($resourceArray);

        return $resourceArray->getTotal();
    }

    /**
     * @param \Contentful\Core\Resource\ResourceArray $resourceArray
     *
     * @return void
     */
    protected function importResource(ResourceArray $resourceArray): void
    {
        /** @var \Contentful\Delivery\Resource\Entry $entry */
        foreach ($resourceArray->getItems() as $entry) {
            $this->import($entry);
        }
    }

    /**
     * @param \Contentful\Delivery\Resource\Entry $entry
     *
     * @return void
     */
    protected function import(Entry $entry): void
    {
        foreach ($this->localeMapping as $contentfulLocale => $locale) {
            $entry->setLocale($contentfulLocale);
            $contentfulEntry = $this->contentfulMapper->createContentfulEntry($entry);
            $storageEntry = $this->entryMapper->createEntry($contentfulEntry);
            $this->executePlugins($contentfulEntry, $storageEntry, $locale);
        }
    }

    /**
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Client\Entry\ContentfulEntryInterface $contentfulEntry
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Entry\EntryInterface $storageEntry
     * @param string $locale
     *
     * @return void
     */
    protected function executePlugins(ContentfulEntryInterface $contentfulEntry, EntryInterface $storageEntry, string $locale): void
    {
        foreach ($this->importerPlugins as $index => $plugin) {
            $plugin->handle($contentfulEntry, $storageEntry, $locale);
        }
    }
}
