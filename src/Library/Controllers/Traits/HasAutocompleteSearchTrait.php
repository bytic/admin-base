<?php

namespace ByTIC\AdminBase\Library\Controllers\Traits;

use Throwable;

trait HasAutocompleteSearchTrait
{
    protected function bootHasAutocompleteSearchTrait(): void
    {
    }

    /**
     * Generic endpoint for autocomplete search.
     */
    public function autocompleteSearchAction(): void
    {
        $query = $this->autocompleteSearchNormalizeQuery(
            $this->autocompleteSearchRequestValue($this->autocompleteSearchQueryParameter())
        );
        $limit = $this->autocompleteSearchNormalizeLimit(
            $this->autocompleteSearchRequestValue($this->autocompleteSearchLimitParameter())
        );

        if ($query === '') {
            $this->autocompleteSearchRespondJson(
                $this->autocompleteSearchSuccessPayload([], $query, $limit)
            );
            return;
        }

        try {
            $records = $this->autocompleteSearchFetchRecords($query, $limit);
            $results = [];
            foreach ($records as $record) {
                $results[] = $this->autocompleteSearchFormatRecord($record);
            }

            $this->autocompleteSearchRespondJson(
                $this->autocompleteSearchSuccessPayload($results, $query, $limit)
            );
        } catch (Throwable $exception) {
            $this->autocompleteSearchRespondJson(
                $this->autocompleteSearchErrorPayload(
                    'search_failed',
                    $this->autocompleteSearchErrorMessage($exception)
                ),
                500
            );
        }
    }

    /**
     * Must be implemented by consumer controller.
     */
    abstract protected function autocompleteSearchFetchRecords(string $query, int $limit): iterable;

    protected function autocompleteSearchQueryParameter(): string
    {
        return 'q';
    }

    protected function autocompleteSearchLimitParameter(): string
    {
        return 'limit';
    }

    protected function autocompleteSearchDefaultLimit(): int
    {
        return 10;
    }

    protected function autocompleteSearchMaxLimit(): int
    {
        return 50;
    }

    protected function autocompleteSearchErrorMessage(Throwable $exception): string
    {
        return 'Search could not be completed.';
    }

    protected function autocompleteSearchNormalizeQuery(mixed $query): string
    {
        if ($query === null) {
            return '';
        }
        return trim((string) $query);
    }

    protected function autocompleteSearchNormalizeLimit(mixed $limit): int
    {
        $default = $this->autocompleteSearchDefaultLimit();
        $max = max(1, $this->autocompleteSearchMaxLimit());
        $normalized = (int) ($limit ?: $default);
        if ($normalized < 1) {
            return $default;
        }
        return min($normalized, $max);
    }

    protected function autocompleteSearchRequestValue(string $key): mixed
    {
        if (isset($_REQUEST[$key])) {
            return $_REQUEST[$key];
        }

        if (method_exists($this, 'request')) {
            $request = $this->request();
            if (is_object($request) && method_exists($request, 'get')) {
                return $request->get($key);
            }
        }

        if (method_exists($this, 'getRequest')) {
            $request = $this->getRequest();
            if (is_object($request) && method_exists($request, 'get')) {
                return $request->get($key);
            }
        }

        return null;
    }

    protected function autocompleteSearchFormatRecord(mixed $record): array
    {
        $id = $this->autocompleteSearchExtractValue($record, ['id', 'value']);
        $label = $this->autocompleteSearchExtractValue($record, ['label', 'name', 'title', 'value']);

        return [
            'id' => $id,
            'label' => (string) $label,
        ];
    }

    protected function autocompleteSearchExtractValue(mixed $record, array $keys): mixed
    {
        foreach ($keys as $key) {
            if (is_array($record) && array_key_exists($key, $record)) {
                return $record[$key];
            }
            if (is_object($record) && isset($record->{$key})) {
                return $record->{$key};
            }
            if (is_object($record)) {
                $method = 'get' . ucfirst($key);
                if (method_exists($record, $method)) {
                    return $record->{$method}();
                }
            }
        }

        return null;
    }

    protected function autocompleteSearchSuccessPayload(array $results, string $query, int $limit): array
    {
        return [
            'success' => true,
            'data' => $results,
            'meta' => [
                'query' => $query,
                'limit' => $limit,
                'count' => count($results),
            ],
        ];
    }

    protected function autocompleteSearchErrorPayload(string $code, string $message, array $details = []): array
    {
        return [
            'success' => false,
            'error' => [
                'code' => $code,
                'message' => $message,
                'details' => $details,
            ],
        ];
    }

    protected function autocompleteSearchRespondJson(array $payload, int $statusCode = 200): void
    {
        if (!headers_sent()) {
            http_response_code($statusCode);
            header('Content-Type: application/json; charset=utf-8');
        }

        echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
