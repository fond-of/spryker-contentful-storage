<?php

namespace FondOfSpryker\Service\ContentfulStorage\Plugin;

use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Spryker\Service\Kernel\AbstractPlugin;
use Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface;

/**
 * Class ContentfulStorageKeyGeneratorPlugin
 *
 * @package FondOfSpryker\Service\ContentfulStorage\Plugin
 * @method \FondOfSpryker\Service\ContentfulStorage\ContentfulStorageServiceFactory getFactory()
 */
class ContentfulStorageKeyGeneratorPlugin extends AbstractPlugin implements SynchronizationKeyGeneratorPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\SynchronizationDataTransfer $dataTransfer
     *
     * @return string
     */
    public function generateKey(SynchronizationDataTransfer $dataTransfer): string
    {
        $this->getFactory()->createFosContentfulQuery()->clear();

        /** @var \Orm\Zed\Contentful\Persistence\FosContentful $entity */
        $entity = $this->getFactory()
            ->createFosContentfulQuery()
            ->findPk($dataTransfer->getReference());

        return $entity->getStorageKey();
    }
}
