<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Dependency\Facade;

use FondOfSpryker\Zed\ContentfulPageSearch\Business\ContentfulPageSearchFacadeInterface;

class ContentfulStorageToContentfulPageSearchFacadeBridge implements ContentfulStorageToContentfulPageSearchFacadeInterface
{
    /**
     * @var \FondOfSpryker\Zed\ContentfulPageSearch\Business\ContentfulPageSearchFacadeInterface
     */
    protected $contentfulPageSearchFacade;

    /**
     * @param \FondOfSpryker\Zed\ContentfulPageSearch\Business\ContentfulPageSearchFacadeInterface $contentfulPageSearchFacade
     */
    public function __construct(ContentfulPageSearchFacadeInterface $contentfulPageSearchFacade)
    {
        $this->contentfulPageSearchFacade = $contentfulPageSearchFacade;
    }

    /**
     * @param array $contentfulEntryIds
     *
     * @return void
     */
    public function publish(array $contentfulEntryIds): void
    {
        $this->contentfulPageSearchFacade->publish($contentfulEntryIds);
    }

    /**
     * @param array $contentfulEntryIds
     *
     * @return void
     */
    public function update(array $contentfulEntryIds): void
    {
        $this->contentfulPageSearchFacade->unpublish($contentfulEntryIds);
    }
}
