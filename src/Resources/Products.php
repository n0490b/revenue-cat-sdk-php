<?php

declare(strict_types=1);

namespace Lanos\RevenueCat\Resources;

use Lanos\RevenueCat\Exceptions\RevenueCatException;
use Lanos\RevenueCat\Traits\ProjectIdTrait;
class Products extends AbstractResource
{
    /**
     * Get a product by ID
     *
     * @param string $id
     * @param array<string, mixed> $params Optional parameters like 'expand'
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function get(string $id, array $params = []): array
    {
        $projectId = $this->extractProjectId($params);
        return $this->client->get("/projects/{$projectId}/products/{$id}");
    }

    /**
     * List products for a project
     *
     * @param array<string, mixed> $params Optional parameters like 'app_id', 'starting_after', 'limit', 'expand'
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function list(array $params = []): array
    {
        $projectId = $this->extractProjectId($params);
        return $this->client->get("/projects/{$projectId}/products", $params);
    }

    /**
     * Create a product
     *
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function create(array $data): array
    {
        $projectId = $this->extractProjectId($data);
        return $this->client->post("/projects/{$projectId}/products", $data);
    }

    /**
     * Delete a product
     *
     * @param string $id
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function delete(string $id, array $params = []): array
    {
        $projectId = $this->extractProjectId($params);
        return $this->client->delete("/projects/{$projectId}/products/{$id}");
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
