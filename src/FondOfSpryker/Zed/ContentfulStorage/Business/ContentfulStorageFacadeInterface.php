<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business;

interface ContentfulStorageFacadeInterface
{
    /**
     * @param array $contentfulEntryIds
     *
     * @return void
     */
    public function publish(array $contentfulEntryIds): void;

    /**
     * @param array $contentfulEntryIds
     *
     * @return void
     */
    public function update(array $contentfulEntryIds): void;

    /**
     * @param array $contentfulEntryIds
     *
     * @return void
     */
    public function unpublish(array $contentfulEntryIds): void;
}
