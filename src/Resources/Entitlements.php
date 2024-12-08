<?php

declare(strict_types=1);

namespace Lanos\RevenueCat\Resources;

use Lanos\RevenueCat\Exceptions\RevenueCatException;

class Entitlements extends AbstractResource
{
    /**
     * Get an entitlement by ID
     *
     * @param string $projectId
     * @param string $entitlementId
     * @param array<string, mixed> $params Optional parameters like 'expand'
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function get(string $projectId, string $entitlementId, array $params = []): array
    {
        return $this->client->get("/projects/{$projectId}/entitlements/{$entitlementId}", $params);
    }

    /**
     * List entitlements for a project
     *
     * @param string $projectId
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function list(string $projectId, array $params = []): array
    {
        return $this->client->get("/projects/{$projectId}/entitlements", $params);
    }

    /**
     * Create an entitlement
     *
     * @param string $projectId
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function create(string $projectId, array $data): array
    {
        return $this->client->post("/projects/{$projectId}/entitlements", $data);
    }

    /**
     * Update an entitlement
     *
     * @param string $projectId
     * @param string $entitlementId
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function update(string $projectId, string $entitlementId, array $data): array
    {
        return $this->client->post("/projects/{$projectId}/entitlements/{$entitlementId}", $data);
    }

    /**
     * Delete an entitlement
     *
     * @param string $projectId
     * @param string $entitlementId
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function delete(string $projectId, string $entitlementId): array
    {
        return $this->client->delete("/projects/{$projectId}/entitlements/{$entitlementId}");
    }

    /**
     * Get products attached to an entitlement
     *
     * @param string $projectId
     * @param string $entitlementId
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function getProducts(string $projectId, string $entitlementId, array $params = []): array
    {
        return $this->client->get("/projects/{$projectId}/entitlements/{$entitlementId}/products", $params);
    }

    /**
     * Attach products to an entitlement
     *
     * @param string $projectId
     * @param string $entitlementId
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function attachProducts(string $projectId, string $entitlementId, array $data): array
    {
        return $this->client->post(
            "/projects/{$projectId}/entitlements/{$entitlementId}/actions/attach_products",
            $data
        );
    }

    /**
     * Detach products from an entitlement
     *
     * @param string $projectId
     * @param string $entitlementId
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function detachProducts(string $projectId, string $entitlementId, array $data): array
    {
        return $this->client->post(
            "/projects/{$projectId}/entitlements/{$entitlementId}/actions/detach_products",
            $data
        );
    }

    protected function getResourcePath(): string
    {
        return 'entitlements';
    }
}
