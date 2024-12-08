<?php

declare(strict_types=1);

namespace Lanos\RevenueCat\Config;

/**
 * Configuration class for RevenueCat SDK
 */
class Configuration
{
    private const API_VERSION = 'v2';
    private const BASE_URL = 'https://api.revenuecat.com';

    /**
     * @param string $apiKey RevenueCat API key
     * @param int $timeout Request timeout in seconds
     * @param array<string, string> $headers Additional headers to send with each request
     */
    public function __construct(
        private string $apiKey,
        private int $timeout = 30,
        private array $headers = []
    ) {
    }

    /**
     * Get the API key
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * Set the API key
     */
    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * Get the request timeout
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * Set the request timeout
     */
    public function setTimeout(int $timeout): self
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * Get additional headers
     *
     * @return array<string, string>
     */
    public function getHeaders(): array
    {
        return array_merge(
            $this->headers,
            [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        );
    }

    /**
     * Set additional headers
     *
     * @param array<string, string> $headers
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * Get the base URL for API requests
     */
    public function getBaseUrl(): string
    {
        return self::BASE_URL . '/' . self::API_VERSION;
    }

    /**
     * Get the API version
     */
    public function getApiVersion(): string
    {
        return self::API_VERSION;
    }
}
