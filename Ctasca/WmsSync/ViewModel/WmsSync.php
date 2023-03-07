<?php
declare(strict_types=1);

namespace Ctasca\WmsSync\ViewModel;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Ctasca\WmsSync\Logger\Logger;

class WmsSync implements ArgumentInterface
{
    /**
     * @param RequestInterface $request
     * @param ProductRepositoryInterface $productRepository
     * @param Logger $logger
     */
    public function __construct(
        private readonly RequestInterface $request,
        private readonly ProductRepositoryInterface $productRepository,
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
     * @return int
     */
    private function getProductId(): int
    {
        return (int)$this->request->getParam('id');
    }
}
