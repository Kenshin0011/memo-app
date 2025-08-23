<?php

declare(strict_types=1);

namespace App\Services\UseCases\Memos;

use App\Models\Memo;
use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * Class DeleteUseCase
 * @package App\Services\UseCases\Memos
 */
class DeleteUseCase
{
    /**
     * @param array $inputData 入力データ
     * @throws Throwable
     */
    public function __invoke(array $inputData)
    {
        return DB::transaction(function () use ($inputData) {
            $memo = Memo::findOrFail($inputData['id']);
            $memo->delete();

            return [];
        });
    }
}
