<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Text;

use DateTimeInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Client\Entry\ContentfulEntryInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Client\Field\ContentfulField;
use FondOfSpryker\Zed\ContentfulStorage\Business\Client\Field\ContentfulFieldInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\FieldInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\FieldMapperLocatorInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\TypeFieldMapperInterface;

class TextFieldMapper implements TypeFieldMapperInterface
{
    /**
     * @return string
     */
    public function getContentfulType(): string
    {
        return ContentfulField::FIELD_TYPE_TEXT;
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
        $content = $contentfulField->getValue();
        if ($content === null) {
            $content = '';
        }

        if ($content instanceof DateTimeInterface) {
            $content = $content->format('Y-m-d H:i:s');
        }

        return new TextField($contentfulField->getId(), $content);
    }
}
