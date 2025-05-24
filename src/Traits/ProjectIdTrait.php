<?php

declare(strict_types=1);

namespace Lanos\RevenueCat\Traits;

use Lanos\RevenueCat\Exceptions\RevenueCatException;

trait ProjectIdTrait
{
    /**
     * Extract and validate project ID from parameters
     *
     * @param array<string, mixed> $params
     * @return string
     * @throws RevenueCatException
     */
    protected function extractProjectId(array $params): string
    {
        $projectId = $params['project_id'] ?? null;
        if (!$projectId) {
            throw new RevenueCatException('project_id is required in params');
        }
        return $projectId;
    }
}