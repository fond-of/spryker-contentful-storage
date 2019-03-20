<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field;

abstract class AbstractField implements FieldInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
