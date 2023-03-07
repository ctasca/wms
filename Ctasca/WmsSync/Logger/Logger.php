<?php
declare(strict_types=1);

namespace Ctasca\WmsSync\Logger;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Logger extends \Monolog\Logger
{
    /**
     * Path to system config
     */
    const LOGGING_ENABLED_CONFIG_PATH = 'wmssync/settings/enable_logging';

    /**
     * @param string $name
     * @param ScopeConfigInterface $scopeConfig
     * @param array $handlers
     * @param array $processors
     */
    public function __construct(
        string $name,
        private readonly ScopeConfigInterface $scopeConfig,
        array $handlers = [],
        array $processors = []
    ) {
        parent::__construct($name, $handlers, $processors);
    }

    /**
     * {@inheritdoc}
     */
    public function info($message, array $context = []): void
    {
        if ($this->isLoggingEnabled()) {
            rparent::info($message, $context);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function error($message, array $context = []): void
    {
        if ($this->isLoggingEnabled()) {
            parent::error($message, $context);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function debug($message, array $context = []): void
    {
        if ($this->isLoggingEnabled()) {
            parent::debug($message, $context);
        }
    }

    /**
     * @return bool
     */
    private function isLoggingEnabled(): bool
    {
        return (bool) $this->scopeConfig->getValue(self::LOGGING_ENABLED_CONFIG_PATH);
    }
}
