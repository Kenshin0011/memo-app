<?php

declare(strict_types=1);

namespace App\Services\UseCases\Memos;

use App\Models\Memo;
use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * Class CreateUseCase
 * @package App\Services\UseCases\Memos
 */
class CreateUseCase
{
    /**
     * @param array $inputData 入力データ
     * @throws Throwable
     */
    public function __invoke(array $inputData)
    {
        return DB::transaction(function () use ($inputData) {
            $memo = Memo::create([
                'description' => $inputData['description'],
            ]);

            return [
                'memo' => $memo,
                'message' => 'メモが作成されました。'
            ];
        });
    }
}
