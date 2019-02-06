<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Dependency\Facade;

use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;

class ContentfulStorageToEventBehaviorFacadeBridge implements ContentfulStorageToEventBehaviorFacadeInterface
{
    /**
     * @var \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface
     */
    protected $eventBehaviorFacade;

    /**
     * @param \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface $eventBehaviorFacade
     */
    public function __construct(EventBehaviorFacadeInterface $eventBehaviorFacade)
    {
        $this->eventBehaviorFacade = $eventBehaviorFacade;
    }

    /**
     * @param array $eventTransfers
     *
     * @return array
     */
    public function getEventTransferIds(array $eventTransfers): array
    {
        return $this->eventBehaviorFacade->getEventTransferIds($eventTransfers);
    }
}
