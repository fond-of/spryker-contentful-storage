<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Entry;

use FondOfSpryker\Zed\ContentfulStorage\Business\Client\Entry\ContentfulEntryInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\FieldMapperLocatorInterface;

class EntryMapper implements EntryMapperInterface
{
    /**
     * @var \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\FieldMapperLocatorInterface
     */
    private $mapperLocator;

    /**
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\FieldMapperLocatorInterface $mapperLocator
     */
    public function __construct(FieldMapperLocatorInterface $mapperLocator)
    {
        $this->mapperLocator = $mapperLocator;
    }

    /**
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Client\Entry\ContentfulEntryInterface $contentfulEntry
     *
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Entry\EntryInterface
     */
    public function createEntry(ContentfulEntryInterface $contentfulEntry): EntryInterface
    {
        $entry = new Entry($contentfulEntry->getId(), $contentfulEntry->getContentTypeId());

        foreach ($contentfulEntry->getFields() as $contentfulField) {
            $mapper = $this->mapperLocator->locateFieldMapperBy($contentfulEntry, $contentfulField);
            $storageField = $mapper->createField($contentfulEntry, $contentfulField, $this->mapperLocator);
            $entry->addField($storageField);
        }

        return $entry;
    }
}
