<?php

namespace FondOfSpryker\Service\ContentfulStorage\Plugin;

use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Orm\Zed\Contentful\Persistence\FosContentfulQuery;
use Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface;
use Spryker\Service\Synchronization\Plugin\BaseKeyGenerator;

class ContentfulStorageKeyGeneratorPlugin extends BaseKeyGenerator implements SynchronizationKeyGeneratorPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\SynchronizationDataTransfer $dataTransfer
     *
     * @return string
     */
    public function generateKey(SynchronizationDataTransfer $dataTransfer): string
    {
        /** @var \Orm\Zed\Contentful\Persistence\FosContentful $entity */
        $entity = FosContentfulQuery::create()
            ->findPk($dataTransfer->getReference());

        $storeName = strtolower($entity->getStoreName());
        $locale = strtolower($entity->getContentfulLocale());

        return $storeName . '.' . $locale . '.contentful.xxxxx.' . $entity->getContentfulId();
    }
}
