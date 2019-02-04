<?php

namespace FondOfSpryker\Client\ContentfulStorage;

interface ContentfulStorageClientInterface
{
    /**
     * Specification:
     * - Maps raw CMS page storage data to transfer object.
     *
     * @param array $data
     */
    public function mapContentfulStorageData(array $data);
}
