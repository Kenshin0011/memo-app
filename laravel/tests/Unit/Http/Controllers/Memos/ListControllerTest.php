<?php

declare(strict_types=1);

namespace Tests\Unit\Http\Controllers\Memos;

use App\Http\Controllers\Memos\ListController;
use App\Models\Memo;
use App\Services\UseCases\Memos\ListUseCase;
use Illuminate\Http\Response;
use Mockery;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use Tests\TestCase;
use Tests\Unit\Traits\MockEloquentModel;

#[CoversClass(ListController::class)]
class ListControllerTest extends TestCase
{
    use MockEloquentModel;

    /**
     * @return void
     * @throws \Throwable
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function testNormal(): void
    {
        $memoMock = $this->createModelMock(Memo::class, [
            'id' => 1,
            'description' => 'Test memo',
            'created_at' => now(),
        ]);

        $outputData = ['memos' => [$memoMock]];

        // モック生成（ユースケース）
        $useCaseMock = Mockery::mock(ListUseCase::class);
        $useCaseMock->shouldReceive('__invoke')
            ->once()
            ->andReturn($outputData);
        $this->instance(ListUseCase::class, $useCaseMock);

        // 検証
        $actual = app(ListController::class)($useCaseMock);
        $this->assertSame(Response::HTTP_OK, $actual->getStatusCode());

        $responseData = json_decode($actual->getContent(), true);
        $this->assertIsArray($responseData);
        $this->assertCount(1, $responseData);
    }

    /**
     * @return void
     * @throws \Throwable
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function testEmptyList(): void
    {
        $outputData = ['memos' => []];

        // モック生成（ユースケース）
        $useCaseMock = Mockery::mock(ListUseCase::class);
        $useCaseMock->shouldReceive('__invoke')
            ->once()
            ->andReturn($outputData);
        $this->instance(ListUseCase::class, $useCaseMock);

        // 検証
        $actual = app(ListController::class)($useCaseMock);
        $this->assertSame(Response::HTTP_OK, $actual->getStatusCode());

        $responseData = json_decode($actual->getContent(), true);
        $this->assertIsArray($responseData);
        $this->assertCount(0, $responseData);
    }

    /**
     * @return void
     * @throws \Throwable
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function testException(): void
    {
        // モック生成（ユースケース）
        $useCaseMock = Mockery::mock(ListUseCase::class);
        $useCaseMock->shouldReceive('__invoke')
            ->once()
            ->andThrow(new \Exception('Test exception'));
        $this->instance(ListUseCase::class, $useCaseMock);

        // 検証
        $actual = app(ListController::class)($useCaseMock);
        $this->assertSame(Response::HTTP_INTERNAL_SERVER_ERROR, $actual->getStatusCode());

        $responseData = json_decode($actual->getContent(), true);
        $this->assertEquals([
            'error' => '予期しないエラー',
            'message' => '処理中にエラーが発生しました'
        ], $responseData);
    }
}
