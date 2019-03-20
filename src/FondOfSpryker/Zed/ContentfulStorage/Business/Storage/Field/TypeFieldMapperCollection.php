<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field;

class TypeFieldMapperCollection implements TypeFieldMapperCollectionInterface
{
    /**
     * @var \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\TypeFieldMapperInterface[]
     */
    private $typeFieldMapper;

    public function __construct()
    {
        $this->typeFieldMapper = [];
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\TypeFieldMapperInterface[]
     */
    public function getAll(): array
    {
        return $this->typeFieldMapper;
    }

    /**
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\TypeFieldMapperInterface $typeFieldMapper
     *
     * @return void
     */
    public function add(TypeFieldMapperInterface $typeFieldMapper): void
    {
        $this->typeFieldMapper[] = $typeFieldMapper;
    }
}
