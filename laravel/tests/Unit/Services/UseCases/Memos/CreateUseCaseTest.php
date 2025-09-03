<?php

declare(strict_types=1);

namespace Tests\Unit\Services\UseCases\Memos;

use App\Models\Memo;
use App\Services\UseCases\Memos\CreateUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\TestCase;

#[CoversClass(CreateUseCase::class)]
class CreateUseCaseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     * @throws \Throwable
     */
    public function testInvoke(): void
    {
        $inputData = ['description' => 'Test memo description'];

        $useCase = new CreateUseCase();
        $result = $useCase($inputData);

        $this->assertArrayHasKey('memo', $result);
        $this->assertArrayHasKey('message', $result);
        $this->assertEquals('メモが作成されました。', $result['message']);

        $memo = $result['memo'];
        $this->assertInstanceOf(Memo::class, $memo);
        $this->assertEquals('Test memo description', $memo->description);
        $this->assertNotNull($memo->id);

        // データベースにも保存されているか確認
        $this->assertDatabaseHas('memos', [
            'description' => 'Test memo description'
        ]);
    }

    /**
     * @return void
     * @throws \Throwable
     */
    public function testInvokeWithLongDescription(): void
    {
        $longDescription = str_repeat('あ', 1000);
        $inputData = ['description' => $longDescription];

        $useCase = new CreateUseCase();
        $result = $useCase($inputData);

        $this->assertArrayHasKey('memo', $result);
        $memo = $result['memo'];
        $this->assertEquals($longDescription, $memo->description);

        $this->assertDatabaseHas('memos', [
            'description' => $longDescription
        ]);
    }
}