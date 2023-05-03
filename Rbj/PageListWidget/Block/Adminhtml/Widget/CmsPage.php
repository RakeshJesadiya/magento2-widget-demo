<?php
declare(strict_types=1);

/**
 * @author Rakesh Jesadiya <rakesh@rakeshjesadiya.com>
 * @package Rbj_PageListWidget
 */
namespace Rbj\PageListWidget\Block\Adminhtml\Widget;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Rbj\PageListWidget\Model\Source\CmsPageList;
use Magento\Cms\Model\ResourceModel\Page\Collection;

/**
 * CMS Page List Widget Block
 */
class CmsPage extends Template implements BlockInterface
{
    private const SPECIFIC_PAGES = 'specific_pages';
    private const DISPLAY_MODE = 'display_mode';
    private const TYPES = 'types';

    public function __construct(Context $context, private readonly CmsPageList $cmsPageList, array $data = [])
    {
        parent::__construct($context, $data);
    }

    /**
     * Get Selected CMS Page from current widget.
     *
     * @return Collection
     * @throws NoSuchEntityException
     */
    public function getCmsPageCollection() : Collection
    {
        $storeId = (int)$this->_storeManager->getStore()->getId();
        $displayMode = $this->getData(self::DISPLAY_MODE);

        $types = [];
        if ($displayMode === self::SPECIFIC_PAGES) {
            $types[] = explode(',', $this->getData(self::TYPES)); // @phpstan-ignore-line
        }

        return $this->cmsPageList->getCmsPageList($storeId, $types);
    }
}
