<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Link;

use FondOfSpryker\Zed\ContentfulStorage\Business\Client\Asset\ContentfulAssetInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Client\Entry\ContentfulEntryInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Client\Field\ContentfulField;
use FondOfSpryker\Zed\ContentfulStorage\Business\Client\Field\ContentfulFieldInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\FieldInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\FieldMapperLocatorInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\TypeFieldMapperInterface;

class LinkFieldMapper implements TypeFieldMapperInterface
{
    /**
     * @return string
     */
    public function getContentfulType(): string
    {
        return ContentfulField::FIELD_TYPE_LINK;
    }

    /**
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Client\Entry\ContentfulEntryInterface $contentfulEntry
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Client\Field\ContentfulFieldInterface $contentfulField
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\FieldMapperLocatorInterface $mapperLocator
     *
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\FieldInterface
     */
    public function createField(ContentfulEntryInterface $contentfulEntry, ContentfulFieldInterface $contentfulField, FieldMapperLocatorInterface $mapperLocator): FieldInterface
    {
        $mapper = null;
        if ($contentfulField instanceof ContentfulAssetInterface) {
            $mapper = $mapperLocator->locateFieldMapperByFieldType(ContentfulField::FIELD_TYPE_ASSET);
        }

        if ($contentfulField->getLinkType() === ContentfulField::FIELD_TYPE_ENTRY) {
            $mapper = $mapperLocator->locateFieldMapperByFieldType(ContentfulField::FIELD_TYPE_ENTRY);
        }

        if ($mapper === null) {
            $mapper = $mapperLocator->locateFieldMapperByFieldType(ContentfulField::FIELD_TYPE_TEXT);
        }
        
        return $mapper->createField($contentfulEntry, $contentfulField, $mapperLocator);
    }
}
