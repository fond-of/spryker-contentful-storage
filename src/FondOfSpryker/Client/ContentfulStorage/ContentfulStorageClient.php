<?php

namespace FondOfSpryker\Client\ContentfulStorage;

use Spryker\Client\Kernel\AbstractClient;

/**
 * Class ContentfulStorageClient
 * @package FondOfSpryker\Client\ContentfulStorage
 * @method \FondOfSpryker\Client\ContentfulStorage\ContentfulStorageFactory getFactory()
 */
class ContentfulStorageClient extends AbstractClient implements ContentfulStorageClientInterface
{
    /**
     * Specification:
     * - Maps raw CMS page storage data to transfer object.
     *
     * @param array $data
     *
     * @return void
     */
    public function mapContentfulStorageData(array $data)
    {
    }
}
