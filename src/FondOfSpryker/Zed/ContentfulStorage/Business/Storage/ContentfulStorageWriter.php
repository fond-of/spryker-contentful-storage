<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business\Storage;

use Generated\Shared\Transfer\ContentfulStorageTransfer;
use Orm\Zed\Contentful\Persistence\FosContentfulQuery;
use Orm\Zed\ContentfulStorage\Persistence\FosContentfulStorage;

class ContentfulStorageWriter implements ContentfulStorageWriterInterface
{
    /**
     * ContentfulStorageWriter constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param array $contentfulEntryIds
     *
     * @return void
     */
    public function publish(array $contentfulEntryIds): void
    {
        $contentfulEntries = FosContentfulQuery::create()
            ->filterByIdContentful_In($contentfulEntryIds);

        /** @var \Orm\Zed\Contentful\Persistence\FosContentful $entry */
        foreach ($contentfulEntries as $entry) {
            $contentfulStorageTransfer = new ContentfulStorageTransfer();
            $contentfulStorageTransfer->fromArray($entry->toArray(), true);

            $this->store($entry->getPrimaryKey(), $contentfulStorageTransfer);
        }
    }

    /**
     * @param array $contentfulEntryIds
     *
     * @return void
     */
    public function unpublish(array $contentfulEntryIds): void
    {
        // TODO: Implement unpublish() method.
    }

    /**
     * @param array $contentfulIds
     *
     * @return mixed
     */
    protected function getContentfulEntry(array $contentfulIds)
    {
        return FosContentfulQuery::create()
            ->filterByContentfulId_In($contentfulIds)
            ->find();
    }

    /**
     * @param int $contentfulId
     * @param \Generated\Shared\Transfer\ContentfulStorageTransfer $contentfulStorageTransfer
     *
     * @return void
     */
    protected function store(int $contentfulId, ContentfulStorageTransfer $contentfulStorageTransfer): void
    {
        $contentfulStorageEntity = new FosContentfulStorage();
        $contentfulStorageEntity->setFkContentful($contentfulId);
        $contentfulStorageEntity->setData($contentfulStorageTransfer->getContentfulData());
        $contentfulStorageEntity->setKey($contentfulStorageTransfer->getStorageKey());
        $contentfulStorageEntity->save();
    }
}
