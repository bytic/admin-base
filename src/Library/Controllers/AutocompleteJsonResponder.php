<?php

declare(strict_types=1);

namespace ByTIC\AdminBase\Library\Controllers;

use JsonException;

final class AutocompleteJsonResponder
{
    public static function respond(array $payload, int $statusCode = 200): void
    {
        try {
            $encodedPayload = json_encode(
                $payload,
                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR
            );
        } catch (JsonException) {
            if (!headers_sent()) {
                http_response_code(500);
                header('Content-Type: application/json; charset=utf-8');
            }
            echo '{"success":false,"error":{"code":"json_encode_failed","message":"Response encoding failed."}}';
            return;
        }

        if (!headers_sent()) {
            http_response_code($statusCode);
            header('Content-Type: application/json; charset=utf-8');
        }

        echo $encodedPayload;
    }
}
