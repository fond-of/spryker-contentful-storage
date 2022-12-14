<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business\Storage;

use Generated\Shared\Transfer\ContentfulStorageTransfer;
use Orm\Zed\Contentful\Persistence\FosContentfulQuery;
use Orm\Zed\ContentfulStorage\Persistence\FosContentfulStorage;
use Orm\Zed\ContentfulStorage\Persistence\FosContentfulStorageQuery;

class ContentfulStorageWriter implements ContentfulStorageWriterInterface
{
    /**
     * @var \Orm\Zed\Contentful\Persistence\FosContentfulQuery
     */
    protected $contentfulQuery;

    /**
     * @var \Orm\Zed\ContentfulStorage\Persistence\FosContentfulStorageQuery
     */
    protected $contentfulStorageQuery;

    /**
     * @param \Orm\Zed\Contentful\Persistence\FosContentfulQuery $contentfulQuery
     * @param \Orm\Zed\ContentfulStorage\Persistence\FosContentfulStorageQuery $contentfulStorageQuery
     */
    public function __construct(
        FosContentfulQuery $contentfulQuery,
        FosContentfulStorageQuery $contentfulStorageQuery
    ) {
        $this->contentfulQuery = $contentfulQuery;
        $this->contentfulStorageQuery = $contentfulStorageQuery;
    }

    /**
     * @param array $contentfulEntryIds
     *
     * @return void
     */
    public function publish(array $contentfulEntryIds): void
    {
        $this->contentfulQuery->clear();
        $contentfulEntries = $this->contentfulQuery
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
        $this->contentfulStorageQuery->clear();

        $contentfulStorageEntries = $this->contentfulStorageQuery
            ->filterByFkContentful_In($contentfulEntryIds);

        /** @var \Orm\Zed\ContentfulStorage\Persistence\FosContentfulStorage $entry */
        foreach ($contentfulStorageEntries as $entry) {
            $entry->delete();
        }
    }

    /**
     * @param int $contentfulId
     * @param \Generated\Shared\Transfer\ContentfulStorageTransfer $contentfulStorageTransfer
     *
     * @return void
     */
    protected function store(int $contentfulId, ContentfulStorageTransfer $contentfulStorageTransfer): void
    {
        $contentfulStorageEntity = $this->findorCreateContentfulStorageEntity($contentfulId, $contentfulStorageTransfer);

        // delete existing URL (identifier) from table fos_contentful_storage
        if ($contentfulStorageEntity->isNew() === false && $contentfulStorageEntity->getEntryTypeId() === 'page-identifier') {
            $this->deleteContentfulStorageEntity($contentfulStorageEntity);

            $contentfulStorageEntity = new FosContentfulStorage();
        }

        $contentfulStorageEntity
            ->setFkContentful($contentfulId)
            ->setData($contentfulStorageTransfer->getEntryData())
            ->setEntryId(strtolower($contentfulStorageTransfer->getEntryId()))
            ->setEntryTypeId($contentfulStorageTransfer->getEntryTypeId());

        $contentfulStorageEntity->save();
    }

    /**
     * @param \Orm\Zed\ContentfulStorage\Persistence\FosContentfulStorage $contentfulStorage
     *
     * @return void
     */
    protected function deleteContentfulStorageEntity(FosContentfulStorage $contentfulStorage): void
    {
        $this->contentfulStorageQuery->clear();

        $this->contentfulStorageQuery
            ->filterByIdContentfulStorage($contentfulStorage->getPrimaryKey())
            ->delete();
    }

    /**
     * @param int $contentfulId
     * @param \Generated\Shared\Transfer\ContentfulStorageTransfer $contentfulStorageTransfer
     *
     * @return \Orm\Zed\ContentfulStorage\Persistence\FosContentfulStorage
     */
    protected function findorCreateContentfulStorageEntity(int $contentfulId, ContentfulStorageTransfer $contentfulStorageTransfer): FosContentfulStorage
    {
        $this->contentfulStorageQuery->clear();

        return $this->contentfulStorageQuery
            ->filterByFkContentful($contentfulId)
            ->filterByEntryId($contentfulStorageTransfer->getEntryId())
            ->filterByEntryTypeId($contentfulStorageTransfer->getEntryTypeId())
            ->findOneOrCreate();
    }
}
