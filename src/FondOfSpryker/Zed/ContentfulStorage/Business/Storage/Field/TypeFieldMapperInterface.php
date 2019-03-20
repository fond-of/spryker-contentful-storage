<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Field;

interface TypeFieldMapperInterface extends FieldMapperInterface
{
    /**
     * @return string
     */
    public function getContentfulType(): string;
}
