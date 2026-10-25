<?php

declare(strict_types=1);

namespace ByTIC\AdminBase\Tests\Library\Controllers;

use ByTIC\AdminBase\Library\Controllers\AutocompleteJsonResponder;
use ByTIC\AdminBase\Tests\AbstractTest;

class AutocompleteJsonResponderTest extends AbstractTest
{
    public function test_responds_with_unescaped_json(): void
    {
        $previousStatusCode = http_response_code();
        ob_start();
        try {
            AutocompleteJsonResponder::respond(['label' => 'Café / tea']);
            $response = ob_get_contents();
        } finally {
            ob_end_clean();
            if ($previousStatusCode !== false) {
                http_response_code($previousStatusCode);
            }
        }

        self::assertSame('{"label":"Café / tea"}', $response);
    }

    public function test_encoding_failure_returns_an_error_payload(): void
    {
        $previousStatusCode = http_response_code();
        ob_start();
        try {
            AutocompleteJsonResponder::respond(['label' => "\xB1"]);
            $response = ob_get_contents();
        } finally {
            ob_end_clean();
            if ($previousStatusCode !== false) {
                http_response_code($previousStatusCode);
            }
        }

        self::assertSame(
            '{"success":false,"error":{"code":"json_encode_failed","message":"Response encoding failed."}}',
            $response
        );
    }
}
