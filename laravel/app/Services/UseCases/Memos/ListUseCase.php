<?php

declare(strict_types=1);

namespace App\Services\UseCases\Memos;

use App\Models\Memo;
use Throwable;

/**
 * Class ListUseCase
 * @package App\Services\UseCases\Memos
 */
class ListUseCase
{
    /**
     * @throws Throwable
     */
    public function __invoke(): array
    {
        $memos = Memo::query()->orderBy("created_at", "desc")->get();
        return ["memos" => $memos];
    }
}
