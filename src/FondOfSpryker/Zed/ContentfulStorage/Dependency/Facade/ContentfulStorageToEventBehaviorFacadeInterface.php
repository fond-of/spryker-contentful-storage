<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Dependency\Facade;

interface ContentfulStorageToEventBehaviorFacadeInterface
{
    /**
     * @param array $eventTransfers
     *
     * @return mixed
     */
    public function getEventTransferIds(array $eventTransfers);
}
