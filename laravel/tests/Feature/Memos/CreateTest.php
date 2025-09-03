<?php

declare(strict_types=1);

namespace Tests\Feature\Memos;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * メモ作成APIの結合テスト
 */
class CreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return string
     */
    private function getRouteName(): string
    {
        return 'memos.create';
    }

    /**
     * @return void
     */
    public function testOk(): void
    {
        $data = [
            'description' => 'Test memo description'
        ];

        $response = $this->postJson(route($this->getRouteName()), $data);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => ['id', 'description', 'createdAt'],
                'message'
            ]);

        $this->assertDatabaseHas('memos', [
            'description' => 'Test memo description'
        ]);
    }

    /**
     * @param array $data
     * @return void
     */
    #[DataProvider('validationErrorProvider')]
    public function testValidationError(array $data): void
    {
        $response = $this->postJson(route($this->getRouteName()), $data);

        $response->assertStatus(422);
    }

    /**
     * @return array<string, array<array<string, string>>>
     */
    public static function validationErrorProvider(): array
    {
        return [
            '空の説明' => [['description' => '']],
            '説明なし' => [[]],
            'null値' => [['description' => null]],
        ];
    }
}
