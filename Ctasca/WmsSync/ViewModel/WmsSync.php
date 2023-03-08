<?php
declare(strict_types=1);

namespace Ctasca\WmsSync\ViewModel;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Ctasca\WmsSync\Logger\Logger;

class WmsSync implements ArgumentInterface
{
    const SYNC_PRODUCT_TYPES_CONFIG_PATH = 'wmssync/settings/sync_product_types';

    /**
     * @param RequestInterface $request
     * @param ProductRepositoryInterface $productRepository
     * @param ScopeConfigInterface $scopeConfig
     * @param Logger $logger
     */
    public function __construct(
        private readonly RequestInterface $request,
        private readonly ProductRepositoryInterface $productRepository,
        private readonly ScopeConfigInterface $scopeConfig,
        private readonly Logger $logger,
    ){}

    /**
     * @return ProductInterface|null
     */
    public function getProduct(): ProductInterface|null
    {
        try {
            return $this->productRepository->getById($this->getProductId());
        } catch (NoSuchEntityException $e) {
            $this->logger->error($e->getMessage());
            return null;
        }
    }

    /**
     * @param string $productType
     * @return bool
     */
    public function isSyncingAllowed(string $productType): bool
    {
        return in_array($productType, $this->getSyncProductTypes());
    }

    /**
     * @return int
     */
    private function getProductId(): int
    {
        return (int)$this->request->getParam('id');
    }

    /**
     * @return array
     */
    private function getSyncProductTypes(): array
    {
        $types = [];
        $configTypes = $this->scopeConfig->getValue(self::SYNC_PRODUCT_TYPES_CONFIG_PATH, ScopeInterface::SCOPE_STORE);
        if ($configTypes) {
            $types = explode(',', $configTypes);
        }
        return $types;
    }
}
