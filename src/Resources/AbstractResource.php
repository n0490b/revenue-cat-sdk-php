<?php

declare(strict_types=1);

namespace Lanos\RevenueCat\Resources;

use Lanos\RevenueCat\Contracts\ClientInterface;
use Lanos\RevenueCat\Exceptions\RevenueCatException;

abstract class AbstractResource
{
    public function __construct(
        protected readonly ClientInterface $client
    ) {
    }

    /**
     * Get a resource by ID
     *
     * @param string $id
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    protected function get(string $id, array $params = []): array
    {
        return $this->client->get($this->getResourcePath() . '/' . $id, $params);
    }

    /**
     * List resources
     *
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    protected function list(array $params = []): array
    {
        return $this->client->get($this->getResourcePath(), $params);
    }

    /**
     * Create a resource
     *
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    protected function create(array $data): array
    {
        return $this->client->post($this->getResourcePath(), $data);
    }

    /**
     * Delete a resource
     *
     * @param string $id
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    protected function delete(string $id): array
    {
        return $this->client->delete($this->getResourcePath() . '/' . $id);
    }

    /**
     * Update a resource
     *
     * @param string $id
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    protected function update(string $id, array $data): array
    {
        return $this->client->post($this->getResourcePath() . '/' . $id, $data);
    }

    /**
     * Get the base path for the resource
     */
    abstract protected function getResourcePath(): string;
}
