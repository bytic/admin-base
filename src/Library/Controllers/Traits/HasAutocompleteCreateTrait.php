<?php

namespace ByTIC\AdminBase\Library\Controllers\Traits;

use Throwable;

trait HasAutocompleteCreateTrait
{
    protected function bootHasAutocompleteCreateTrait(): void
    {
    }

    /**
     * Generic endpoint for inline create in autocomplete components.
     */
    public function autocompleteCreateAction(): void
    {
        $name = $this->autocompleteCreateNormalizeName(
            $this->autocompleteCreateRequestValue($this->autocompleteCreateNameParameter())
        );

        if ($name === '') {
            $this->autocompleteCreateRespondJson(
                $this->autocompleteCreateErrorPayload('invalid_name', 'Please provide a valid name.'),
                422
            );
            return;
        }

        try {
            $duplicate = $this->autocompleteCreateFindDuplicateRecord($name);
            if ($duplicate !== null && !$this->autocompleteCreateAllowDuplicates()) {
                $this->autocompleteCreateRespondJson(
                    $this->autocompleteCreateErrorPayload(
                        'duplicate',
                        'An item with the same name already exists.',
                        ['record' => $this->autocompleteCreateFormatRecord($duplicate)]
                    ),
                    409
                );
                return;
            }

            $record = $this->autocompleteCreatePersistRecord($name);
            if ($record === null) {
                $this->autocompleteCreateRespondJson(
                    $this->autocompleteCreateErrorPayload('create_failed', 'The item could not be created.'),
                    500
                );
                return;
            }

            $this->autocompleteCreateRespondJson(
                [
                    'success' => true,
                    'data' => $this->autocompleteCreateFormatRecord($record),
                    'meta' => [
                        'created' => true,
                    ],
                ],
                201
            );
        } catch (Throwable $exception) {
            $this->autocompleteCreateRespondJson(
                $this->autocompleteCreateErrorPayload(
                    'create_failed',
                    $this->autocompleteCreateErrorMessage($exception)
                ),
                500
            );
        }
    }

    /**
     * Must be implemented by consumer controller.
     */
    abstract protected function autocompleteCreatePersistRecord(string $name): mixed;

    protected function autocompleteCreateNameParameter(): string
    {
        return 'name';
    }

    protected function autocompleteCreateAllowDuplicates(): bool
    {
        return false;
    }

    protected function autocompleteCreateErrorMessage(Throwable $exception): string
    {
        return 'The item could not be created.';
    }

    protected function autocompleteCreateFindDuplicateRecord(string $name): mixed
    {
        return null;
    }

    protected function autocompleteCreateRequestValue(string $key): mixed
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

    protected function autocompleteCreateNormalizeName(mixed $name): string
    {
        if ($name === null) {
            return '';
        }
        return trim((string) $name);
    }

    protected function autocompleteCreateFormatRecord(mixed $record): array
    {
        $id = $this->autocompleteCreateExtractValue($record, ['id', 'value']);
        $label = $this->autocompleteCreateExtractValue($record, ['label', 'name', 'title', 'value']);

        return [
            'id' => $id,
            'label' => (string) $label,
        ];
    }

    protected function autocompleteCreateExtractValue(mixed $record, array $keys): mixed
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

    protected function autocompleteCreateErrorPayload(string $code, string $message, array $details = []): array
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

    protected function autocompleteCreateRespondJson(array $payload, int $statusCode = 200): void
    {
        if (!headers_sent()) {
            http_response_code($statusCode);
            header('Content-Type: application/json; charset=utf-8');
        }

        echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
