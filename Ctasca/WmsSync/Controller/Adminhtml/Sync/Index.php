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
    private static int $errorFaker = 0;

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
        static::$errorFaker = rand(1, 4);
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
        $this->logger->info(
            "Error Faker Number",
            [static::$errorFaker]
        );
        return $jsonResponse->setData(["result" => $this->jsonSerializer->unserialize($endpointResponse->getBody())]);
    }

    /**
     * Returns product sku if the remainder of execute counter divided by 3 is not 0.
     * Allows to simulate an error on the endpoint by not passing the product SKU to the API endpoint.
     *
     * @return string
     */
    private function getProductSku(): string
    {
        if (static::$errorFaker % 3 === 0) {
            return '';
        }
        return $this->request->getParam('sku');
    }
}
