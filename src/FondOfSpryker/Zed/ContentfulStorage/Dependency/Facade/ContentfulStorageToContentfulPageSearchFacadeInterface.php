<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Dependency\Facade;

interface ContentfulStorageToContentfulPageSearchFacadeInterface
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
}
