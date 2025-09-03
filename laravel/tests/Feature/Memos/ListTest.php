<?php

declare(strict_types=1);

namespace Tests\Feature\Memos;

use App\Models\Memo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * メモ一覧APIの結合テスト
 */
class ListTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return string
     */
    private function getRouteName(): string
    {
        return 'memos.list';
    }

    /**
     * @return void
     */
    public function testOkEmpty(): void
    {
        $response = $this->getJson(route($this->getRouteName()));

        $response->assertStatus(200)
            ->assertJson([]);
    }

    /**
     * @return void
     */
    public function testOkMultiple(): void
    {
        Memo::factory()->create(['description' => 'First memo']);
        Memo::factory()->create(['description' => 'Second memo']);

        $response = $this->getJson(route($this->getRouteName()));

        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'description', 'createdAt']
            ])
            ->assertJsonCount(2);
    }

    /**
     * @return void
     */
    public function testOkOrder(): void
    {
        Memo::factory()->create(['description' => 'Old memo']);
        sleep(1);
        Memo::factory()->create(['description' => 'New memo']);

        $response = $this->getJson(route($this->getRouteName()));

        $response->assertStatus(200);

        $data = $response->json();
        $this->assertEquals('New memo', $data[0]['description']);
        $this->assertEquals('Old memo', $data[1]['description']);
    }
}
