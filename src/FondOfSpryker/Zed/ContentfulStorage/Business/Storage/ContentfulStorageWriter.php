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
     * ContentfulStorageWriter constructor.
     *
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
        // TODO: Implement unpublish() method.
    }

    /**
     * @param int $contentfulId
     * @param \Generated\Shared\Transfer\ContentfulStorageTransfer $contentfulStorageTransfer
     *
     * @return void
     */
    protected function store(int $contentfulId, ContentfulStorageTransfer $contentfulStorageTransfer): void
    {
        $contentfulStorageEntity = $this->getContentfulStorageEntity($contentfulId, $contentfulStorageTransfer->getStorageKey());
        $contentfulStorageEntity->setFkContentful($contentfulId);
        $contentfulStorageEntity->setData($contentfulStorageTransfer->getEntryData());

        $contentfulStorageEntity->save();
    }

    /**
     * @param int $contentfulId
     *
     * @return \Orm\Zed\Contentful\Persistence\FosContentful
     */
    protected function getContentfulStorageEntity(int $contentfulId, string $key): FosContentfulStorage
    {
        $this->contentfulStorageQuery->clear();

        return $this->contentfulStorageQuery
            ->filterByFkContentful($contentfulId)
            ->filterByKey($key)
            ->findOneOrCreate();
    }
}
