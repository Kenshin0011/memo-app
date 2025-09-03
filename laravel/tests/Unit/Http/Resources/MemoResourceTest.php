<?php

declare(strict_types=1);

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\MemoResource;
use App\Models\Memo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mockery;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\TestCase;
use Tests\Unit\Traits\MockEloquentModel;

#[CoversClass(MemoResource::class)]
class MemoResourceTest extends TestCase
{
    use MockEloquentModel;

    /**
     * @return void
     */
    public function testToArray(): void
    {
        $createdAt = Carbon::parse('2024-01-01 12:00:00');

        // Memoモックを作成
        $memoMock = $this->createModelMock(Memo::class, [
            'id' => 1,
            'description' => 'Test memo description',
            'created_at' => $createdAt,
        ]);

        // Requestモックを作成
        $requestMock = Mockery::mock(Request::class);

        // MemoResourceをテスト
        $resource = new MemoResource($memoMock);
        $result = $resource->toArray($requestMock);

        $expected = [
            'id' => 1,
            'description' => 'Test memo description',
            'createdAt' => '2024-01-01 12:00:00',
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     * @return void
     */
    public function testToArrayWithNullValues(): void
    {
        $createdAt = Carbon::parse('2024-01-01 12:00:00');

        // Memoモックを作成
        $memoMock = $this->createModelMock(Memo::class, [
            'id' => null,
            'description' => null,
            'created_at' => $createdAt,
        ]);

        // Requestモックを作成
        $requestMock = Mockery::mock(Request::class);

        // MemoResourceをテスト
        $resource = new MemoResource($memoMock);
        $result = $resource->toArray($requestMock);

        $expected = [
            'id' => null,
            'description' => null,
            'createdAt' => '2024-01-01 12:00:00',
        ];

        $this->assertEquals($expected, $result);
    }
}
