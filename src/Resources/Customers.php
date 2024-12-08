<?php

declare(strict_types=1);

namespace Lanos\RevenueCat\Resources;

use Lanos\RevenueCat\Exceptions\RevenueCatException;

class Customers extends AbstractResource
{
    /**
     * Get a customer by ID
     *
     * @param string $projectId
     * @param string $customerId
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function get(string $projectId, string $customerId): array
    {
        return $this->client->get("/projects/{$projectId}/customers/{$customerId}");
    }

    /**
     * List customers for a project
     *
     * @param string $projectId
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function list(string $projectId, array $params = []): array
    {
        return $this->client->get("/projects/{$projectId}/customers", $params);
    }

    /**
     * Create a customer
     *
     * @param string $projectId
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function create(string $projectId, array $data): array
    {
        return $this->client->post("/projects/{$projectId}/customers", $data);
    }

    /**
     * Delete a customer
     *
     * @param string $projectId
     * @param string $customerId
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function delete(string $projectId, string $customerId): array
    {
        return $this->client->delete("/projects/{$projectId}/customers/{$customerId}");
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
