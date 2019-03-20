<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field;

class CustomFieldMapperCollection implements CustomFieldMapperCollectionInterface
{
    /**
     * @var \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\CustomFieldMapperInterface[]
     */
    private $customFieldMapper;

    public function __construct()
    {
        $this->customFieldMapper = [];
    }

    /**
     * @param \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\CustomFieldMapperInterface $customFieldMapper
     *
     * @return void
     */
    public function add(CustomFieldMapperInterface $customFieldMapper): void
    {
        $this->customFieldMapper[] = $customFieldMapper;
    }

    /**
     * @return \FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field\CustomFieldMapperInterface[]
     */
    public function getAll(): array
    {
        return $this->customFieldMapper;
    }
}
