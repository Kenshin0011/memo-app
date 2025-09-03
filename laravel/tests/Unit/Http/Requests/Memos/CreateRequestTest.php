<?php

declare(strict_types=1);

namespace Tests\Unit\Http\Requests\Memos;

use App\Http\Requests\Memos\CreateRequest;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

#[CoversClass(CreateRequest::class)]
class CreateRequestTest extends TestCase
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
        $validator = Validator::make($data, (new CreateRequest())->rules());
        $this->assertSame($expected, $validator->passes());
    }

    /**
     * @return array
     */
    public static function validateProvider(): array
    {
        $baseParams = ['description' => 'Test memo description'];

        return [
            'OK（すべてのパラメータ）' => [
                'expected' => true,
                'data' => $baseParams,
            ],
            'NG（descriptionがない）' => [
                'expected' => false,
                'data' => [],
            ],
            'NG（descriptionが文字列でない）' => [
                'expected' => false,
                'data' => ['description' => 123],
            ],
            'NG（descriptionがnull）' => [
                'expected' => false,
                'data' => ['description' => null],
            ],
            'NG（descriptionが空文字）' => [
                'expected' => false,
                'data' => ['description' => ''],
            ],
        ];
    }
}
