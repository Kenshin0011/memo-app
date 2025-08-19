<?php

declare(strict_types=1);

namespace App\Services\OutputData;

/**
 * Class OutputData
 * @package App\Services\OutputData
 */
class OutputData
{
    /**
     * メッセージ一覧
     *
     * @var array<int|string, mixed>
     */
    protected array $messages = [];

    /**
     * @param array<int|string, mixed> $attributes 属性
     */
    protected function __construct(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * インスタンスを新規作成する
     *
     * @param array<int|string, mixed> $attributes 属性
     * @return static
     */
    public static function make(array $attributes = []): static
    {
        return new static($attributes);
    }

    /**
     * メッセージを取得する
     *
     * @return array<int|string, mixed>
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * メッセージを設定する
     *
     * @param string $message 指定メッセージ
     * @return static
     */
    public function setMessage(string $message = ''): static
    {
        if ($message !== '') {
            $this->messages[] = $message;
        }

        return $this;
    }
}
