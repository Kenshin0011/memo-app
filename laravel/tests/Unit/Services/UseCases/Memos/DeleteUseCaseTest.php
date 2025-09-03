<?php

declare(strict_types=1);

namespace Tests\Unit\Services\UseCases\Memos;

use App\Models\Memo;
use App\Services\UseCases\Memos\DeleteUseCase;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\TestCase;

#[CoversClass(DeleteUseCase::class)]
class DeleteUseCaseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     * @throws \Throwable
     */
    public function testInvoke(): void
    {
        $memo = Memo::factory()->create(['description' => 'Test memo']);
        $inputData = ['id' => $memo->id];

        $useCase = new DeleteUseCase();
        $result = $useCase($inputData);

        $this->assertEquals([], $result);

        // データベースから削除されているか確認
        $this->assertDatabaseMissing('memos', [
            'id' => $memo->id
        ]);
    }

    /**
     * @return void
     * @throws \Throwable
     */
    public function testInvokeWithNonexistentId(): void
    {
        $this->expectException(ModelNotFoundException::class);

        $inputData = ['id' => 999999];

        $useCase = new DeleteUseCase();
        $useCase($inputData);
    }
}