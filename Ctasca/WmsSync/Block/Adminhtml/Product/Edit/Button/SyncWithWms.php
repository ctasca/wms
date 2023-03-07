<?php
declare(strict_types=1);

namespace Ctasca\WmsSync\Block\Adminhtml\Product\Edit\Button;

use Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Generic;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SyncWithWms extends Generic implements ButtonProviderInterface
{
    /**
     * @inerhitDoc
     */
    public function getButtonData(): array
    {
        if ($this->getProduct()->getId()) {
            return [
                'label' => __('Sync With WMS'),
                'class' => 'action-secondary',
                'on_click' => "return false",
                'sort_order' => 100
            ];
        }
        return [];
    }
}
