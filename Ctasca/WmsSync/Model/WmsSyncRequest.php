<?php
declare(strict_types=1);

namespace Ctasca\WmsSync\Model;

use Magento\Framework\Model\AbstractModel;
use Ctasca\WmsSync\Model\ResourceModel\WmsSyncRequest as WmsSyncRequestResourceModel;
use Ctasca\WmsSync\Api\Data\WmsSyncRequestInterface;

class WmsSyncRequest extends AbstractModel implements WmsSyncRequestInterface
{
    protected function _construct(): void
    {
        $this->_init(WmsSyncRequestResourceModel::class);
    }

    /**
     * @inerhitDoc
     */
    public function getRequestId(): int
    {
        return (int) $this->getData(self::REQUEST_ID);
    }

    /**
     * @inerhitDoc
     */
    public function getResponseStatusCode(): int
    {
        return (int) $this->getData(self::RESPONSE_STATUS_CODE);
    }

    /**
     * @inerhitDoc
     */
    public function getWmsQuantity(): int
    {
        return (int) $this->getData(self::WMS_QUANTITY);
    }

    /**
     * @inerhitDoc
     */
    public function getErrorMessage(): string
    {
        return (string) $this->getData(self::ERROR_MESSAGE);
    }

    /**
     * @inerhitDoc
     */
    public function setResponseStatusCode(int $statusCode): WmsSyncRequestInterface
    {
        return $this->setData(self::RESPONSE_STATUS_CODE, $statusCode);
    }

    /**
     * @inerhitDoc
     */
    public function setWmsQuantity(int $quantity): WmsSyncRequestInterface
    {
        return $this->setData(self::WMS_QUANTITY, $quantity);
    }

    /**
     * @inerhitDoc
     */
    public function setErrorMessage(string $errorMessage): WmsSyncRequestInterface
    {
        return $this->setData(self::ERROR_MESSAGE, $errorMessage);
    }
}
