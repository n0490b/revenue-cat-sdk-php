<?php

declare(strict_types=1);

namespace Lanos\RevenueCat\Resources;

use Lanos\RevenueCat\Exceptions\RevenueCatException;
use Lanos\RevenueCat\Traits\ProjectIdTrait;

class Customers extends AbstractResource
{
    use ProjectIdTrait;

    /**
     * Get a customer by ID
     *
     * @param string $id
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function get(string $id, array $params = []): array
    {
        $projectId = $this->extractProjectId($params);
        return $this->client->get("/projects/{$projectId}/customers/{$id}");
    }

    /**
     * List customers for a project
     *
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function list(array $params = []): array
    {
        $projectId = $this->extractProjectId($params);
        return $this->client->get("/projects/{$projectId}/customers", $params);
    }

    /**
     * Create a customer
     *
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function create(array $data): array
    {
        $projectId = $data['project_id'] ?? null;
        if (!$projectId) {
            throw new RevenueCatException('project_id is required in data');
        }
        return $this->client->post("/projects/{$projectId}/customers", $data);
    }

    /**
     * Delete a customer
     *
     * @param string $id
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function delete(string $id, array $params = []): array
    {
        $projectId = $this->extractProjectId($params);
        return $this->client->delete("/projects/{$projectId}/customers/{$id}");
    }

    /**
     * Get customer's active entitlements
     *
     * @param string $projectId
     * @param string $customerId
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function getActiveEntitlements(string $projectId, string $customerId, array $params = []): array
    {
        return $this->client->get("/projects/{$projectId}/customers/{$customerId}/active_entitlements", $params);
    }

    /**
     * Get customer's subscriptions
     *
     * @param string $projectId
     * @param string $customerId
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function getSubscriptions(string $projectId, string $customerId, array $params = []): array
    {
        return $this->client->get("/projects/{$projectId}/customers/{$customerId}/subscriptions", $params);
    }

    /**
     * Get customer's purchases
     *
     * @param string $projectId
     * @param string $customerId
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function getPurchases(string $projectId, string $customerId, array $params = []): array
    {
        return $this->client->get("/projects/{$projectId}/customers/{$customerId}/purchases", $params);
    }

    /**
     * Get customer's aliases
     *
     * @param string $projectId
     * @param string $customerId
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function getAliases(string $projectId, string $customerId, array $params = []): array
    {
        return $this->client->get("/projects/{$projectId}/customers/{$customerId}/aliases", $params);
    }

    protected function getResourcePath(): string
    {
        return 'customers';
    }
}
