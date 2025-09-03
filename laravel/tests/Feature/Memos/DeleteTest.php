<?php

declare(strict_types=1);

namespace Tests\Feature\Memos;

use App\Models\Memo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * メモ削除APIの結合テスト
 */
class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return string
     */
    private function getRouteName(): string
    {
        return 'memos.delete';
    }

    /**
     * @return void
     */
    public function testOk(): void
    {
        $memo = Memo::factory()->create(['description' => 'Memo to delete']);

        $response = $this->deleteJson(route($this->getRouteName(), ['id' => $memo->id]));

        $response->assertStatus(204);

        $this->assertDatabaseMissing('memos', [
            'id' => $memo->id
        ]);
    }

    /**
     * @param mixed $id
     * @return void
     */
    #[DataProvider('validationErrorProvider')]
    public function testValidationError(mixed $id): void
    {
        $response = $this->deleteJson(route($this->getRouteName(), ['id' => $id]));

        $response->assertStatus(422);
    }

    /**
     * @return array
     */
    public static function validationErrorProvider(): array
    {
        return [
            '文字列ID' => ['abc'],
        ];
    }

    /**
     * @param mixed $id
     * @return void
     */
    #[DataProvider('notFoundProvider')]
    public function testNotFound(mixed $id): void
    {
        $response = $this->deleteJson(route($this->getRouteName(), ['id' => $id]));

        $response->assertStatus(404);
    }

    /**
     * @return array
     */
    public static function notFoundProvider(): array
    {
        return [
            '存在しないID' => [999999],
        ];
    }
}
