<?php

declare(strict_types=1);

namespace App\Http\Controllers\Memos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Memos\DeleteRequest;
use App\Services\UseCases\Memos\DeleteUseCase;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

/**
 * Class DeleteController
 * @package App\Http\Controllers\Memos
 */
class DeleteController extends Controller
{
    /**
     * メモを削除する
     * @param DeleteRequest $request リクエスト
     * @param DeleteUseCase $useCase ユースケース
     * @return JsonResponse
     * @throws \Throwable
     */
    public function __invoke(
        DeleteRequest $request,
        DeleteUseCase $useCase,
    ): JsonResponse
    {
        try {
            $useCase($request->validated());
            return response()->json([], 204);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Not Found',
                'message' => 'メモが見つかりません'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => '予期しないエラー',
                'message' => '処理中にエラーが発生しました'
            ], 500);
        }
    }
}
