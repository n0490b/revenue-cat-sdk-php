<?php

declare(strict_types=1);

namespace Lanos\RevenueCat\Resources;

use Lanos\RevenueCat\Exceptions\RevenueCatException;
use Lanos\RevenueCat\Traits\ProjectIdTrait;

class Offerings extends AbstractResource
{
    use ProjectIdTrait;

    /**
     * Get an offering by ID
     *
     * @param string $id
     * @param array<string, mixed> $params Optional parameters like 'expand'
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function get(string $id, array $params = []): array
    {
        $projectId = $this->extractProjectId($params);
        return $this->client->get("/projects/{$projectId}/offerings/{$id}");
    }

    /**
     * List offerings for a project
     *
     * @param array<string, mixed> $params Optional parameters like 'starting_after', 'limit', 'expand'
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function list(array $params = []): array
    {
        $projectId = $this->extractProjectId($params);
        return $this->client->get("/projects/{$projectId}/offerings", $params);
    }

    /**
     * Create an offering
     *
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function create(array $data): array
    {
        $projectId = $this->extractProjectId($data);
        return $this->client->post("/projects/{$projectId}/offerings", $data);
    }

    /**
     * Update an offering
     *
     * @param string $id
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function update(string $id, array $data): array
    {
        $projectId = $this->extractProjectId($data);
        return $this->client->post("/projects/{$projectId}/offerings/{$id}", $data);
    }

    /**
     * Delete an offering
     *
     * @param string $id
     * @param array<string, mixed> $params Optional parameters
     * @return array<string, mixed>
     * @throws RevenueCatException
     */
    public function delete(string $id, array $params = []): array
    {
        $projectId = $this->extractProjectId($params);
        return $this->client->delete("/projects/{$projectId}/offerings/{$id}");
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
