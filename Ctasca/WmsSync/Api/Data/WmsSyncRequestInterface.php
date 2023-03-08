<?php
declare(strict_types=1);

namespace Ctasca\WmsSync\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface WmsSyncRequestInterface extends ExtensibleDataInterface
{
    const REQUEST_ID = 'request_id';
    const RESPONSE_STATUS_CODE = 'response_status_code';
    const WMS_QUANTITY = 'wms_quantity';
    const SKU = 'sku';
    const ERROR_MESSAGE = 'error_message';

    /**
     * @return int
     */
    public function getRequestId(): int;

    /**
     * @return int
     */
    public function getResponseStatusCode(): int;

    /**
     * @return int
     */
    public function getWmsQuantity(): int;

    /**
     * @return string|null
     */
    public function getSku(): string|null;

    /**
     * @return string|null
     */
    public function getErrorMessage(): string|null;

    /**
     * @param int $statusCode
     * @return WmsSyncRequestInterface
     */
    public function setResponseStatusCode(int $statusCode): WmsSyncRequestInterface;

    /**
     * @param int $quantity
     * @return WmsSyncRequestInterface
     */
    public function setWmsQuantity(int $quantity): WmsSyncRequestInterface;

    /**
     * @param string $sku
     * @return WmsSyncRequestInterface
     */
    public function setSku(string $sku): WmsSyncRequestInterface;

    /**
     * @param string $errorMessage
     * @return WmsSyncRequestInterface
     */
    public function setErrorMessage(string $errorMessage): WmsSyncRequestInterface;
}
