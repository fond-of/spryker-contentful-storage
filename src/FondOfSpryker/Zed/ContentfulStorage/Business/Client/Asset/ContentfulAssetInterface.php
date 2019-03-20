<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business\Client\Asset;

use FondOfSpryker\Zed\ContentfulStorage\Business\Client\Field\ContentfulFieldInterface;

interface ContentfulAssetInterface extends ContentfulFieldInterface
{
    /**
     * @return null|string
     */
    public function getDescription(): ?string;

    /**
     * @return null|string
     */
    public function getTitle(): ?string;
}
