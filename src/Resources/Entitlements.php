<?php

declare(strict_types=1);

namespace Lanos\RevenueCat\Resources;

use Lanos\RevenueCat\Exceptions\RevenueCatException;
use Lanos\RevenueCat\Traits\ProjectIdTrait;
class Entitlements extends AbstractResource
{
    use ProjectIdTrait;
    /**
     * Get an entitlement by ID
     *
     * @param string $id
     * @param array<string, mixed> $params Optional parameters like 'expand'
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function get(string $id, array $params = []): array
    {
        $projectId = $this->extractProjectId($params);
        return $this->client->get("/projects/{$projectId}/entitlements/{$id}");
    }

    /**
     * List entitlements for a project
     *
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function list(array $params = []): array
    {
        $projectId = $this->extractProjectId($params);
        return $this->client->get("/projects/{$projectId}/entitlements", $params);
    }

    /**
     * Create an entitlement
     *
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function create(array $data): array
    {
        $projectId = $this->extractProjectId($data);
        return $this->client->post("/projects/{$projectId}/entitlements", $data);
    }

    /**
     * Update an entitlement
     *
     * @param string $id
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function update(string $id, array $data): array
    {
        $projectId = $this->extractProjectId($data);
        return $this->client->post("/projects/{$projectId}/entitlements/{$id}", $data);
    }

    /**
     * Delete an entitlement
     *
     * @param string $id
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function delete(string $id, array $params = []): array
    {
        $projectId = $this->extractProjectId($params);
        return $this->client->delete("/projects/{$projectId}/entitlements/{$id}");
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
