<?php

namespace ByTIC\AdminBase\Tests\Library\Controllers\Traits;

use ByTIC\AdminBase\Library\Controllers\Traits\HasAutocompleteCreateTrait;
use ByTIC\AdminBase\Tests\AbstractTest;

class HasAutocompleteCreateTraitTest extends AbstractTest
{
    public function tearDown(): void
    {
        parent::tearDown();
        $_REQUEST = [];
    }

    public function test_empty_name_returns_validation_error(): void
    {
        $_REQUEST = ['name' => '   '];

        $controller = new AutocompleteCreateControllerFixture();
        $controller->autocompleteCreateAction();

        self::assertSame(422, $controller->statusCode);
        self::assertFalse($controller->payload['success']);
        self::assertSame('invalid_name', $controller->payload['error']['code']);
    }

    public function test_duplicate_name_returns_duplicate_error(): void
    {
        $_REQUEST = ['name' => 'Existing'];

        $controller = new AutocompleteCreateControllerFixture();
        $controller->duplicate = ['id' => 9, 'name' => 'Existing'];
        $controller->autocompleteCreateAction();

        self::assertSame(409, $controller->statusCode);
        self::assertFalse($controller->payload['success']);
        self::assertSame('duplicate', $controller->payload['error']['code']);
        self::assertSame(9, $controller->payload['error']['details']['record']['id']);
    }

    public function test_successful_create_returns_created_payload(): void
    {
        $_REQUEST = ['name' => 'New item'];

        $controller = new AutocompleteCreateControllerFixture();
        $controller->created = ['id' => 12, 'name' => 'New item'];
        $controller->autocompleteCreateAction();

        self::assertSame(201, $controller->statusCode);
        self::assertTrue($controller->payload['success']);
        self::assertSame(12, $controller->payload['data']['id']);
        self::assertSame('New item', $controller->payload['data']['label']);
        self::assertTrue($controller->payload['meta']['created']);
    }
}

class AutocompleteCreateControllerFixture
{
    use HasAutocompleteCreateTrait;

    public mixed $duplicate = null;
    public mixed $created = null;
    public array $payload = [];
    public int $statusCode = 0;

    protected function autocompleteCreatePersistRecord(string $name): mixed
    {
        return $this->created;
    }

    protected function autocompleteCreateFindDuplicateRecord(string $name): mixed
    {
        return $this->duplicate;
    }

    protected function autocompleteCreateRespondJson(array $payload, int $statusCode = 200): void
    {
        $this->payload = $payload;
        $this->statusCode = $statusCode;
    }
}
