<?php

declare(strict_types=1);

namespace Tests\Unit\Http\Controllers\Memos;

use App\Http\Controllers\Memos\CreateController;
use App\Http\Requests\Memos\CreateRequest;
use App\Models\Memo;
use App\Services\UseCases\Memos\CreateUseCase;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use Tests\TestCase;
use Tests\Unit\Traits\MockEloquentModel;

#[CoversClass(CreateController::class)]
class CreateControllerTest extends TestCase
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
        $validated = ['description' => 'Test memo'];

        $memoMock = $this->createModelMock(Memo::class, [
            'id' => 1,
            'description' => 'Test memo',
            'created_at' => now(),
        ]);

        $outputData = [
            'memo' => $memoMock,
            'message' => 'メモを作成しました'
        ];

        // モック生成（リクエスト）
        $requestMock = Mockery::mock(CreateRequest::class);
        $requestMock->shouldReceive('validated')
            ->once()
            ->andReturn($validated);
        $this->instance(CreateRequest::class, $requestMock);

        // モック生成（ユースケース）
        $useCaseMock = Mockery::mock(CreateUseCase::class);
        $useCaseMock->shouldReceive('__invoke')
            ->once()
            ->with($validated)
            ->andReturn($outputData);
        $this->instance(CreateUseCase::class, $useCaseMock);

        // 検証
        $actual = app(CreateController::class)($requestMock, $useCaseMock);
        $this->assertSame(Response::HTTP_CREATED, $actual->getStatusCode());

        $responseData = json_decode($actual->getContent(), true);
        $this->assertArrayHasKey('data', $responseData);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertEquals('メモを作成しました', $responseData['message']);
    }

    /**
     * @return void
     * @throws \Throwable
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function testException(): void
    {
        $validated = ['description' => 'Test memo'];

        // モック生成（リクエスト）
        $requestMock = Mockery::mock(CreateRequest::class);
        $requestMock->shouldReceive('validated')
            ->once()
            ->andReturn($validated);
        $this->instance(CreateRequest::class, $requestMock);

        // モック生成（ユースケース）
        $useCaseMock = Mockery::mock(CreateUseCase::class);
        $useCaseMock->shouldReceive('__invoke')
            ->once()
            ->with($validated)
            ->andThrow(new Exception('Test exception'));
        $this->instance(CreateUseCase::class, $useCaseMock);

        // 検証
        $actual = app(CreateController::class)($requestMock, $useCaseMock);
        $this->assertSame(Response::HTTP_INTERNAL_SERVER_ERROR, $actual->getStatusCode());

        $responseData = json_decode($actual->getContent(), true);
        $this->assertEquals([
            'error' => '予期しないエラー',
            'message' => '処理中にエラーが発生しました'
        ], $responseData);
    }
}
