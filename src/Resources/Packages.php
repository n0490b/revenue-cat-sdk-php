<?php

declare(strict_types=1);

namespace Lanos\RevenueCat\Resources;

use Lanos\RevenueCat\Exceptions\RevenueCatException;
use Lanos\RevenueCat\Traits\ProjectIdTrait;

class Packages extends AbstractResource
{
    use ProjectIdTrait;
    /**
     * Get a package by ID
     *
     * @param string $id
     * @param array<string, mixed> $params Optional parameters like 'expand'
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function get(string $id, array $params = []): array
    {
        $projectId = $this->extractProjectId($params);
        return $this->client->get("/projects/{$projectId}/packages/{$id}", $params);
    }

    /**
     * Update a package
     *
     * @param string $id
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function update(string $id, array $data): array
    {
        $projectId = $this->extractProjectId($data);
        return $this->client->post("/projects/{$projectId}/packages/{$id}", $data);
    }

    /**
     * Delete a package
     *
     * @param string $id
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function delete(string $id, array $params = []): array
    {
        $projectId = $this->extractProjectId($params);
        return $this->client->delete("/projects/{$projectId}/packages/{$id}");
    }

    /**
     * Get products attached to a package
     *
     * @param string $projectId
     * @param string $packageId
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function getProducts(string $projectId, string $packageId, array $params = []): array
    {
        return $this->client->get("/projects/{$projectId}/packages/{$packageId}/products", $params);
    }

    /**
     * Attach products to a package
     *
     * @param string $projectId
     * @param string $packageId
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function attachProducts(string $projectId, string $packageId, array $data): array
    {
        return $this->client->post(
            "/projects/{$projectId}/packages/{$packageId}/actions/attach_products",
            $data
        );
    }

    /**
     * Detach products from a package
     *
     * @param string $projectId
     * @param string $packageId
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function detachProducts(string $projectId, string $packageId, array $data): array
    {
        return $this->client->post(
            "/projects/{$projectId}/packages/{$packageId}/actions/detach_products",
            $data
        );
    }

    protected function getResourcePath(): string
    {
        return 'packages';
    }
}
