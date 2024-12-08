<?php

declare(strict_types=1);

namespace Lanos\RevenueCat\Contracts;

use Lanos\RevenueCat\Exceptions\RevenueCatException;

/**
 * Main interface for RevenueCat API client
 */
interface ClientInterface
{
    /**
     * Get the API version
     */
    public function getApiVersion(): string;

    /**
     * Set the API key
     */
    public function setApiKey(string $apiKey): self;

    /**
     * Get the API key
     */
    public function getApiKey(): string;

    /**
     * Make a GET request to the API
     *
     * @param string $endpoint
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function get(string $endpoint, array $params = []): array;

    /**
     * Make a POST request to the API
     *
     * @param string $endpoint
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function post(string $endpoint, array $data = []): array;

    /**
     * Make a DELETE request to the API
     *
     * @param string $endpoint
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function delete(string $endpoint): array;
}
