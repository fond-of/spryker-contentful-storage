<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field;

interface CustomFieldMapperCollectionInterface
{
    /**
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\CustomFieldMapperInterface $customFieldMapper
     *
     * @return void
     */
    public function add(CustomFieldMapperInterface $customFieldMapper): void;

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\CustomFieldMapperInterface[]
     */
    public function getAll(): array;
}
