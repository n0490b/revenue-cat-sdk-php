<?php

declare(strict_types=1);

namespace Lanos\RevenueCat\Resources;

use Lanos\RevenueCat\Exceptions\RevenueCatException;

class Offerings extends AbstractResource
{
    /**
     * Get an offering by ID
     *
     * @param string $projectId
     * @param string $offeringId
     * @param array<string, mixed> $params Optional parameters like 'expand'
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function get(string $projectId, string $offeringId, array $params = []): array
    {
        return $this->client->get("/projects/{$projectId}/offerings/{$offeringId}", $params);
    }

    /**
     * List offerings for a project
     *
     * @param string $projectId
     * @param array<string, mixed> $params Optional parameters like 'starting_after', 'limit', 'expand'
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function list(string $projectId, array $params = []): array
    {
        return $this->client->get("/projects/{$projectId}/offerings", $params);
    }

    /**
     * Create an offering
     *
     * @param string $projectId
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function create(string $projectId, array $data): array
    {
        return $this->client->post("/projects/{$projectId}/offerings", $data);
    }

    /**
     * Update an offering
     *
     * @param string $projectId
     * @param string $offeringId
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function update(string $projectId, string $offeringId, array $data): array
    {
        return $this->client->post("/projects/{$projectId}/offerings/{$offeringId}", $data);
    }

    /**
     * Delete an offering
     *
     * @param string $projectId
     * @param string $offeringId
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function delete(string $projectId, string $offeringId): array
    {
        return $this->client->delete("/projects/{$projectId}/offerings/{$offeringId}");
    }

    /**
     * Get packages in an offering
     *
     * @param string $projectId
     * @param string $offeringId
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function getPackages(string $projectId, string $offeringId, array $params = []): array
    {
        return $this->client->get("/projects/{$projectId}/offerings/{$offeringId}/packages", $params);
    }

    /**
     * Create a package in an offering
     *
     * @param string $projectId
     * @param string $offeringId
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function createPackage(string $projectId, string $offeringId, array $data): array
    {
        return $this->client->post("/projects/{$projectId}/offerings/{$offeringId}/packages", $data);
    }

    protected function getResourcePath(): string
    {
        return 'offerings';
    }
}
