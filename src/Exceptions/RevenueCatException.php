<?php

declare(strict_types=1);

namespace Lanos\RevenueCat\Exceptions;

use Exception;

/**
 * Base exception class for RevenueCat SDK
 */
class RevenueCatException extends Exception
{
    protected ?string $type = null;
    protected ?string $param = null;
    protected ?string $docUrl = null;
    protected bool $retryable = false;
    protected ?int $backoffMs = null;

    /**
     * @param array<string, mixed> $error Error data from API response
     */
    public static function fromApiError(array $error): self
    {
        $exception = new static(
            $error['message'] ?? 'Unknown error',
            $error['code'] ?? 0
        );

        $exception->type = $error['type'] ?? null;
        $exception->param = $error['param'] ?? null;
        $exception->docUrl = $error['doc_url'] ?? null;
        $exception->retryable = $error['retryable'] ?? false;
        $exception->backoffMs = $error['backoff_ms'] ?? null;

        return $exception;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getParam(): ?string
    {
        return $this->param;
    }

    public function getDocUrl(): ?string
    {
        return $this->docUrl;
    }

    public function isRetryable(): bool
    {
        return $this->retryable;
    }

    public function getBackoffMs(): ?int
    {
        return $this->backoffMs;
    }
}
