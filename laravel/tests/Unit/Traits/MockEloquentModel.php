<?php

declare(strict_types=1);

namespace Tests\Unit\Traits;

use Mockery;
use Mockery\MockInterface;

/**
 * Eloquentモデルモック生成用トレイト
 */
trait MockEloquentModel
{
    /**
     * Eloquentモデルモックを生成
     *
     * @param string $modelClass
     * @param array $attributes
     * @return MockInterface
     */
    private function createModelMock(string $modelClass, array $attributes): MockInterface
    {
        $modelMock = Mockery::mock($modelClass);
        $modelMock->shouldReceive('getAttribute')
            ->andReturnUsing(function ($key) use ($attributes) {
                return $attributes[$key] ?? null;
            });

        return $modelMock;
    }
}
