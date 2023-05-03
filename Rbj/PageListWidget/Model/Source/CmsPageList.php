<?php
declare(strict_types=1);

/**
 * @author Rakesh Jesadiya <rakesh@rakeshjesadiya.com>
 * @package Rbj_PageListWidget
 */
namespace Rbj\PageListWidget\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Cms\Model\ResourceModel\Page\Collection;
use Magento\Cms\Model\ResourceModel\Page\CollectionFactory;

/**
 * CMS Page List Model Source
 */
class CmsPageList implements OptionSourceInterface
{
    public function __construct(
        private CollectionFactory $cmsPageCollectionFactory
    ) {
    }

    /**
     * Return CMS Page list as option array
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        $result = [];
        foreach ($this->getCmsPageList() as $cmsPage) {
            $result[] = ['value' => $cmsPage->getId(), 'label' => $cmsPage->getTitle()]; // @phpstan-ignore-line
        }

        return $result;
    }

    /**
     * Return Collection of CMS pages
     *
     * @param int $storeId
     * @param array $types
     * @return Collection
     */
    public function getCmsPageList(int $storeId = 0, array $types = []): Collection
    {
        $collection = $this->cmsPageCollectionFactory->create();

        if ($storeId) {
            $collection->addStoreFilter($storeId);
        }

        if (!empty($types)) {
            $collection->addFieldToFilter('page_id', ['in' => $types]);
        }
        $collection->addFieldToSelect(['page_id', 'title', 'identifier']);

        return $collection->load();
    }
}
