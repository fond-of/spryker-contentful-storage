<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field;

interface TypeFieldMapperCollectionInterface
{
    /**
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\TypeFieldMapperInterface $typeFieldMapper
     *
     * @return void
     */
    public function add(TypeFieldMapperInterface $typeFieldMapper): void;

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\TypeFieldMapperInterface[]
     */
    public function getAll(): array;
}
