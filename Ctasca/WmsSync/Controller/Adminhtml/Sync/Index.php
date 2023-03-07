<?php
declare(strict_types=1);

namespace Ctasca\WmsSync\Controller\Adminhtml\Sync;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Serialize\Serializer\Json as JsonSerializer;
use Ctasca\WmsSync\Model\Wms\Client;
use Ctasca\WmsSync\Logger\Logger;

class Index extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'Ctasca_WmsSync::sync';

    /**
     * @param Context $context
     * @param RequestInterface $request
     * @param JsonFactory $jsonFactory
     * @param JsonSerializer $jsonSerializer
     * @param Client $client
     * @param Logger $logger
     */
    public function __construct(
        private readonly Context $context,
        private readonly RequestInterface $request,
        private readonly JsonFactory $jsonFactory,
        private readonly JsonSerializer $jsonSerializer,
        private readonly Client $client,
        private readonly Logger $logger
    ){
        parent::__construct($context);
    }

    /**
     * @return Json
     */
    public function execute(): Json
    {
        $jsonResponse = $this->jsonFactory->create();
        $endpointResponse = $this->client->call($this->getProductSku());
        $this->logger->info(
            "Endpoint Response",
            $this->jsonSerializer->unserialize($endpointResponse->getBody())
        );
        $this->logger->info(
            "Endpoint Response Status Code",
            [$endpointResponse->getStatusCode()]
        );
        return $jsonResponse->setData(["result" => $this->jsonSerializer->unserialize($endpointResponse->getBody())]);
    }

    /**
     * @return string
     */
    private function getProductSku(): string
    {
        return $this->request->getParam('sku');
    }
}
