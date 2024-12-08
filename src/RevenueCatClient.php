<?php

declare(strict_types=1);

namespace Lanos\RevenueCat;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use Lanos\RevenueCat\Config\Configuration;
use Lanos\RevenueCat\Contracts\ClientInterface;
use Lanos\RevenueCat\Exceptions\AuthenticationException;
use Lanos\RevenueCat\Exceptions\AuthorizationException;
use Lanos\RevenueCat\Exceptions\NotFoundException;
use Lanos\RevenueCat\Exceptions\RateLimitException;
use Lanos\RevenueCat\Exceptions\RevenueCatException;
use Lanos\RevenueCat\Exceptions\ServerException;
use Lanos\RevenueCat\Exceptions\ValidationException;
use Lanos\RevenueCat\Resources\Customers;
use Lanos\RevenueCat\Resources\Entitlements;
use Lanos\RevenueCat\Resources\Offerings;
use Lanos\RevenueCat\Resources\Packages;
use Lanos\RevenueCat\Resources\Products;
use Psr\Http\Client\ClientInterface as HttpClientInterface;
use Psr\Http\Message\ResponseInterface;

class RevenueCatClient implements ClientInterface
{
    private HttpClientInterface $httpClient;
    private Customers $customers;
    private Entitlements $entitlements;
    private Products $products;
    private Offerings $offerings;
    private Packages $packages;

    public function __construct(
        private readonly Configuration $config,
        ?HttpClientInterface $httpClient = null
    ) {
        $this->httpClient = $httpClient ?? new HttpClient([
            'timeout' => $this->config->getTimeout(),
            'http_errors' => false,
        ]);

        $this->initializeResources();
    }

    private function initializeResources(): void
    {
        $this->customers = new Customers($this);
        $this->entitlements = new Entitlements($this);
        $this->products = new Products($this);
        $this->offerings = new Offerings($this);
        $this->packages = new Packages($this);
    }

    public function customers(): Customers
    {
        return $this->customers;
    }

    public function entitlements(): Entitlements
    {
        return $this->entitlements;
    }

    public function products(): Products
    {
        return $this->products;
    }

    public function offerings(): Offerings
    {
        return $this->offerings;
    }

    public function packages(): Packages
    {
        return $this->packages;
    }

    public function getApiVersion(): string
    {
        return $this->config->getApiVersion();
    }

    public function setApiKey(string $apiKey): ClientInterface
    {
        $this->config->setApiKey($apiKey);
        return $this;
    }

    public function getApiKey(): string
    {
        return $this->config->getApiKey();
    }

    /**
     * @param string $endpoint
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function get(string $endpoint, array $params = []): array
    {
        $url = $this->buildUrl($endpoint);
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }

        try {
            $response = $this->httpClient->request('GET', $url, [
                'headers' => $this->config->getHeaders(),
            ]);

            return $this->handleResponse($response);
        } catch (GuzzleException $e) {
            throw new RevenueCatException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param string $endpoint
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function post(string $endpoint, array $data = []): array
    {
        try {
            $response = $this->httpClient->request('POST', $this->buildUrl($endpoint), [
                'headers' => $this->config->getHeaders(),
                'json' => $data,
            ]);

            return $this->handleResponse($response);
        } catch (GuzzleException $e) {
            throw new RevenueCatException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param string $endpoint
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function delete(string $endpoint): array
    {
        try {
            $response = $this->httpClient->request('DELETE', $this->buildUrl($endpoint), [
                'headers' => $this->config->getHeaders(),
            ]);

            return $this->handleResponse($response);
        } catch (GuzzleException $e) {
            throw new RevenueCatException($e->getMessage(), $e->getCode(), $e);
        }
    }

    private function buildUrl(string $endpoint): string
    {
        return rtrim($this->config->getBaseUrl(), '/') . '/' . ltrim($endpoint, '/');
    }

    /**
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    private function handleResponse(ResponseInterface $response): array
    {
        $statusCode = $response->getStatusCode();
        $data = json_decode((string) $response->getBody(), true) ?? [];

        if ($statusCode >= 200 && $statusCode < 300) {
            return $data;
        }

        $this->handleErrorResponse($statusCode, $data);
    }

    /**
     * @param array<string, mixed> $data
     * @throws RevenueCatException
     */
    private function handleErrorResponse(int $statusCode, array $data): never
    {
        $error = $data['error'] ?? $data;
        
        $exception = match ($statusCode) {
            401 => new AuthenticationException(),
            403 => new AuthorizationException(),
            404 => new NotFoundException(),
            422 => new ValidationException(),
            429 => new RateLimitException(),
            500, 502, 503, 504 => new ServerException(),
            default => new RevenueCatException(),
        };

        throw $exception::fromApiError($error);
    }
}
