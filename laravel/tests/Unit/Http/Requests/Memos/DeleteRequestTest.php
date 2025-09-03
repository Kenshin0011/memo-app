<?php

declare(strict_types=1);

namespace Tests\Unit\Http\Requests\Memos;

use App\Http\Requests\Memos\DeleteRequest;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

#[CoversClass(DeleteRequest::class)]
class DeleteRequestTest extends TestCase
{
    /**
     * @param bool $expected
     * @param array $data
     * @return void
     */
    #[DataProvider('validateProvider')]
    public function testValidated(
        bool  $expected,
        array $data
    ): void
    {
        $validator = Validator::make($data, (new DeleteRequest())->rules());
        $this->assertSame($expected, $validator->passes());
    }

    /**
     * @return array
     */
    public static function validateProvider(): array
    {
        $baseParams = ['id' => 1];

        return [
            'OK（すべてのパラメータ）' => [
                'expected' => true,
                'data' => $baseParams,
            ],
            'NG（idがない）' => [
                'expected' => false,
                'data' => [],
            ],
            'NG（idが整数でない）' => [
                'expected' => false,
                'data' => ['id' => 'abc'],
            ],
            'NG（idがnull）' => [
                'expected' => false,
                'data' => ['id' => null],
            ],
            'NG（idが空文字）' => [
                'expected' => false,
                'data' => ['id' => ''],
            ],
        ];
    }
}