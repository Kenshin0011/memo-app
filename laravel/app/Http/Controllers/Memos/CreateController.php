<?php

declare(strict_types=1);

namespace App\Http\Controllers\Memos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Memos\CreateRequest;
use App\Http\Resources\MemoResource;
use App\Services\UseCases\Memos\CreateUseCase;
use Illuminate\Http\JsonResponse;

/**
 * Class CreateController
 * @package App\Http\Controllers\Memos
 */
class CreateController extends Controller
{
    /**
     * メモを作成する
     * @param CreateRequest $request リクエスト
     * @param CreateUseCase $useCase ユースケース
     * @return JsonResponse
     * @throws \Throwable
     */
    public function __invoke(
        CreateRequest $request,
        CreateUseCase $useCase,
    ): JsonResponse
    {
        try {
            $outputData = $useCase($request->validated());

            return response()->json([
                'data' => new MemoResource($outputData["memo"]),
                'message' => $outputData["message"],
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => '予期しないエラー',
                'message' => '処理中にエラーが発生しました'
            ], 500);
        }
    }
}
