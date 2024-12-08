<?php

declare(strict_types=1);

namespace Lanos\RevenueCat\Resources;

use Lanos\RevenueCat\Exceptions\RevenueCatException;

class Products extends AbstractResource
{
    /**
     * Get a product by ID
     *
     * @param string $projectId
     * @param string $productId
     * @param array<string, mixed> $params Optional parameters like 'expand'
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function get(string $projectId, string $productId, array $params = []): array
    {
        return $this->client->get("/projects/{$projectId}/products/{$productId}", $params);
    }

    /**
     * List products for a project
     *
     * @param string $projectId
     * @param array<string, mixed> $params Optional parameters like 'app_id', 'starting_after', 'limit', 'expand'
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function list(string $projectId, array $params = []): array
    {
        return $this->client->get("/projects/{$projectId}/products", $params);
    }

    /**
     * Create a product
     *
     * @param string $projectId
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function create(string $projectId, array $data): array
    {
        return $this->client->post("/projects/{$projectId}/products", $data);
    }

    /**
     * Delete a product
     *
     * @param string $projectId
     * @param string $productId
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function delete(string $projectId, string $productId): array
    {
        return $this->client->delete("/projects/{$projectId}/products/{$productId}");
    }

    /**
     * Get products from a package
     *
     * @param string $projectId
     * @param string $packageId
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function getFromPackage(string $projectId, string $packageId, array $params = []): array
    {
        return $this->client->get("/projects/{$projectId}/packages/{$packageId}/products", $params);
    }

    /**
     * Get products from an entitlement
     *
     * @param string $projectId
     * @param string $entitlementId
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function getFromEntitlement(string $projectId, string $entitlementId, array $params = []): array
    {
        return $this->client->get("/projects/{$projectId}/entitlements/{$entitlementId}/products", $params);
    }

    protected function getResourcePath(): string
    {
        return 'products';
    }
}
