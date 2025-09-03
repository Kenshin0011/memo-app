<?php

declare(strict_types=1);

namespace Tests\Unit\Http\Controllers\Memos;

use App\Http\Controllers\Memos\DeleteController;
use App\Http\Requests\Memos\DeleteRequest;
use App\Services\UseCases\Memos\DeleteUseCase;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Mockery;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use Tests\TestCase;

#[CoversClass(DeleteController::class)]
class DeleteControllerTest extends TestCase
{
    /**
     * @return void
     * @throws \Throwable
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function testNormal(): void
    {
        $validated = ['id' => 1];

        // モック生成（リクエスト）
        $requestMock = Mockery::mock(DeleteRequest::class);
        $requestMock->shouldReceive('validated')
            ->once()
            ->andReturn($validated);
        $this->instance(DeleteRequest::class, $requestMock);

        // モック生成（ユースケース）
        $useCaseMock = Mockery::mock(DeleteUseCase::class);
        $useCaseMock->shouldReceive('__invoke')
            ->once()
            ->with($validated)
            ->andReturn([]);
        $this->instance(DeleteUseCase::class, $useCaseMock);

        // 検証
        $actual = app(DeleteController::class)($requestMock, $useCaseMock);
        $this->assertSame(Response::HTTP_NO_CONTENT, $actual->getStatusCode());

        $responseData = json_decode($actual->getContent(), true);
        $this->assertEquals([], $responseData);
    }

    /**
     * @return void
     * @throws \Throwable
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function testNotFound(): void
    {
        $validated = ['id' => 999];

        // モック生成（リクエスト）
        $requestMock = Mockery::mock(DeleteRequest::class);
        $requestMock->shouldReceive('validated')
            ->once()
            ->andReturn($validated);
        $this->instance(DeleteRequest::class, $requestMock);

        // モック生成（ユースケース）
        $useCaseMock = Mockery::mock(DeleteUseCase::class);
        $useCaseMock->shouldReceive('__invoke')
            ->once()
            ->with($validated)
            ->andThrow(new ModelNotFoundException('Model not found'));
        $this->instance(DeleteUseCase::class, $useCaseMock);

        // 検証
        $actual = app(DeleteController::class)($requestMock, $useCaseMock);
        $this->assertSame(Response::HTTP_NOT_FOUND, $actual->getStatusCode());

        $responseData = json_decode($actual->getContent(), true);
        $this->assertEquals([
            'error' => 'Not Found',
            'message' => 'メモが見つかりません'
        ], $responseData);
    }

    /**
     * @return void
     * @throws \Throwable
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function testException(): void
    {
        $validated = ['id' => 1];

        // モック生成（リクエスト）
        $requestMock = Mockery::mock(DeleteRequest::class);
        $requestMock->shouldReceive('validated')
            ->once()
            ->andReturn($validated);
        $this->instance(DeleteRequest::class, $requestMock);

        // モック生成（ユースケース）
        $useCaseMock = Mockery::mock(DeleteUseCase::class);
        $useCaseMock->shouldReceive('__invoke')
            ->once()
            ->with($validated)
            ->andThrow(new Exception('Test exception'));
        $this->instance(DeleteUseCase::class, $useCaseMock);

        // 検証
        $actual = app(DeleteController::class)($requestMock, $useCaseMock);
        $this->assertSame(Response::HTTP_INTERNAL_SERVER_ERROR, $actual->getStatusCode());

        $responseData = json_decode($actual->getContent(), true);
        $this->assertEquals([
            'error' => '予期しないエラー',
            'message' => '処理中にエラーが発生しました'
        ], $responseData);
    }
}