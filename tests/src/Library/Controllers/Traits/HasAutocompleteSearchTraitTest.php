<?php

namespace ByTIC\AdminBase\Tests\Library\Controllers\Traits;

use ByTIC\AdminBase\Library\Controllers\Traits\HasAutocompleteSearchTrait;
use ByTIC\AdminBase\Tests\AbstractTest;

class HasAutocompleteSearchTraitTest extends AbstractTest
{
    public function tearDown(): void
    {
        parent::tearDown();
        $_REQUEST = [];
    }

    public function test_empty_query_returns_success_with_empty_data(): void
    {
        $_REQUEST = ['q' => '   '];

        $controller = new AutocompleteSearchControllerFixture();
        $controller->autocompleteSearchAction();

        self::assertSame(200, $controller->statusCode);
        self::assertTrue($controller->payload['success']);
        self::assertSame([], $controller->payload['data']);
        self::assertSame('', $controller->payload['meta']['query']);
    }

    public function test_search_maps_results_and_respects_limit(): void
    {
        $_REQUEST = ['q' => 'ab', 'limit' => 2];

        $controller = new AutocompleteSearchControllerFixture();
        $controller->records = [
            ['id' => 10, 'name' => 'Alpha'],
            (object)['id' => 11, 'label' => 'Beta'],
            ['id' => 12, 'name' => 'Gamma'],
        ];
        $controller->autocompleteSearchAction();

        self::assertSame(200, $controller->statusCode);
        self::assertTrue($controller->payload['success']);
        self::assertCount(2, $controller->payload['data']);
        self::assertSame(10, $controller->payload['data'][0]['id']);
        self::assertSame('Alpha', $controller->payload['data'][0]['label']);
        self::assertSame(11, $controller->payload['data'][1]['id']);
        self::assertSame('Beta', $controller->payload['data'][1]['label']);
        self::assertSame(2, $controller->payload['meta']['limit']);
        self::assertSame(2, $controller->payload['meta']['count']);
    }
}

class AutocompleteSearchControllerFixture
{
    use HasAutocompleteSearchTrait;

    public array $records = [];
    public array $payload = [];
    public int $statusCode = 0;

    protected function autocompleteSearchFetchRecords(string $query, int $limit): iterable
    {
        return array_slice($this->records, 0, $limit);
    }

    protected function autocompleteSearchRespondJson(array $payload, int $statusCode = 200): void
    {
        $this->payload = $payload;
        $this->statusCode = $statusCode;
    }
}
