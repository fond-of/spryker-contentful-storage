<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field;

use FondOfSpryker\Zed\ContentfulStorage\Business\Client\Entry\ContentfulEntryInterface;
use FondOfSpryker\Zed\ContentfulStorage\Business\Client\Field\ContentfulFieldInterface;

interface FieldMapperLocatorInterface
{
    /**
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\FieldMapperInterface $defaultFieldMapper
     *
     * @return void
     */
    public function setDefaultFieldMapper(FieldMapperInterface $defaultFieldMapper): void;

    /**
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Client\Entry\ContentfulEntryInterface $contentfulEntry
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Client\Field\ContentfulFieldInterface $contentfulField
     *
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\FieldMapperInterface
     */
    public function locateFieldMapperBy(ContentfulEntryInterface $contentfulEntry, ContentfulFieldInterface $contentfulField): FieldMapperInterface;

    /**
     * @param string $fieldType
     *
     * @return null|\FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\TypeFieldMapperInterface
     */
    public function locateFieldMapperByFieldType(string $fieldType): ?TypeFieldMapperInterface;

    /**
     * @param string $fieldName
     * @param string $contentType
     *
     * @return null|\FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\CustomFieldMapperInterface
     */
    public function locateFieldMapperByNameAndContentType(string $fieldName, string $contentType): ?CustomFieldMapperInterface;
}
