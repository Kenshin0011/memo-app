<?php

declare(strict_types=1);

namespace App\Http\Controllers\Memos;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemoResource;
use App\Services\UseCases\Memos\ListUseCase;
use Illuminate\Http\JsonResponse;

/**
 * Class ListController
 * @package App\Http\Controllers\Memos
 */
class ListController extends Controller
{
    /**
     * メモを作成する
     * @param ListUseCase $useCase
     * @return JsonResponse
     * @throws \Throwable
     */
    public function __invoke(
        ListUseCase $useCase,
    ): JsonResponse
    {
        try {
            $outputData = $useCase();

            return response()->json(MemoResource::collection($outputData["memos"]));
        } catch (\Exception $e) {
            return response()->json([
                'error' => '予期しないエラー',
                'message' => '処理中にエラーが発生しました'
            ], 500);
        }
    }
}
