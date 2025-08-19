<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class MemoResource
 * @package App\Http\Resources
 */
class MemoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'createdAt' => $this->created_at->toDateTimeString(),
            'description' => $this->description,
            'id' => $this->id,
        ];
    }
}
