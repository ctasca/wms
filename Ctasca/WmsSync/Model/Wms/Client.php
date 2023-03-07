<?php
declare(strict_types=1);

namespace Ctasca\WmsSync\Model\Wms;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Laminas\Http\Client as HttpClient;
use Laminas\Http\Request as HttpRequest;
use Laminas\Http\Response as HttpResponse;
use Magento\Store\Model\ScopeInterface;
use Ctasca\WmsSync\Logger\Logger;

class Client
{
    const SYNC_ENDPOINT_CONFIG_PATH = 'wmssync/settings/sync_endpoint';

    const REQUEST_URI_FORMAT = '%s%s';

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param HttpClient $client
     * @param HttpRequest $request
     * @param HttpResponse $response
     * @param Logger $logger
     */
    public function __construct(
        private readonly ScopeConfigInterface $scopeConfig,
        private readonly HttpClient $client,
        private readonly HttpRequest $request,
        private readonly HttpResponse $response,
        private readonly Logger $logger
    ){}

    /**
     * @param string $sku
     * @return HttpResponse
     */
    public function call(string $sku): HttpResponse
    {
        $requestUri = sprintf(self::REQUEST_URI_FORMAT, $this->getSyncEndpoint(), $sku);
        $this->logger->info("Calling Endpoint URi", [$requestUri]);
        $this->client->setUri($requestUri);
        $this->client->setMethod(HttpRequest::METHOD_GET);
        $this->client->setHeaders(["Content-Type" => 'application/json']);
        return $this->client->send();
    }
    /**
     * @return string
     */
    private function getSyncEndpoint(): string
    {
        return $this->scopeConfig->getValue(self::SYNC_ENDPOINT_CONFIG_PATH, ScopeInterface::SCOPE_STORE);
    }
}
