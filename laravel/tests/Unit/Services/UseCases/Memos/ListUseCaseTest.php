<?php

declare(strict_types=1);

namespace Tests\Unit\Services\UseCases\Memos;

use App\Models\Memo;
use App\Services\UseCases\Memos\ListUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\TestCase;

#[CoversClass(ListUseCase::class)]
class ListUseCaseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     * @throws \Throwable
     */
    public function testInvokeWithEmptyList(): void
    {
        $useCase = new ListUseCase();
        $result = $useCase();

        $this->assertArrayHasKey('memos', $result);
        $this->assertCount(0, $result['memos']);
    }

    /**
     * @return void
     * @throws \Throwable
     */
    public function testInvokeWithMemos(): void
    {
        Memo::factory()->create(['description' => 'First memo']);
        sleep(1);
        Memo::factory()->create(['description' => 'Second memo']);

        $useCase = new ListUseCase();
        $result = $useCase();

        $this->assertArrayHasKey('memos', $result);
        $this->assertCount(2, $result['memos']);
        
        // 並び順確認（新しい順）
        $memos = $result['memos'];
        $this->assertEquals('Second memo', $memos[0]->description);
        $this->assertEquals('First memo', $memos[1]->description);
    }
}