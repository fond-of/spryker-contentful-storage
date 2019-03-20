<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business\Storage\Collection;

use JsonSerializable;

interface CollectionFieldInterface extends JsonSerializable
{
    /**
     * @return string
     */
    public function getType(): string;
}
