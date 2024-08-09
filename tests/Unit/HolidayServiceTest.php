<?php

namespace Tests\Unit;

use App\Models\Holiday;
use App\Models\User;
use App\services\holiday\HolidayService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class HolidayServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAll()
    {
        $user = User::factory()->create();

        Passport::actingAs(
            $user,
            ['getall-holidays']
        );

        $holiday1 = Holiday::factory()->create();
        $holiday2 = Holiday::factory()->create();

        $response = $this->getJson('/api/holiday');
        $this->assertTrue($response->isSuccessful());

        $responseData = $response->getData();
        $this->assertEquals(2, count($responseData->data));

        $this->assertEquals($holiday1->id, $responseData->data[0]->id);
        $this->assertEquals($holiday2->id, $responseData->data[1]->id);
    }

    public function testGetOne() {
        $user = User::factory()->create();

        Passport::actingAs(
            $user,
            ['getone-holidays']
        );

        $holiday1 = Holiday::factory()->create();

        $response = $this->getJson('/api/holiday/' . $holiday1->id);
        $this->assertTrue($response->isSuccessful());

        $responseData = $response->getData();

        $this->assertEquals($holiday1->id, $responseData->data->id);
    }

    public function testCreate() {
        $user = User::factory()->create();

        Passport::actingAs(
            $user,
            ['create-holidays']
        );

        $data = [
            'title' => 'Test Holiday',
            'description' => 'Test Description',
            'date' => '2024-12-25',
            'location' => 'Test Location',
        ];

        $response = $this->postJson('/api/holiday', $data);
        $this->assertTrue($response->isSuccessful());

        $response->assertJsonStructure([
            'message',
            'data' => [
                'title',
                'description',
                'date',
                'location',
                'created_by',
                'id'
            ],
        ]);

        $this->assertDatabaseHas('holiday', [
            'title' => $data['title'],
            'description' => $data['description'],
            'date' => $data['date'],
            'location' => $data['location'],
            'created_by' => $user->id,
        ]);
    }

    public function testUpdateHoliday()
    {
        $user = User::factory()->create();

        Passport::actingAs(
            $user,
            ['update-holidays']
        );

        $holiday = Holiday::create([
            'title' => 'Original Title',
            'description' => 'Original Description',
            'date' => '2024-12-24',
            'location' => 'Original Location',
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $data = [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'date' => '2024-12-26',
            'location' => 'Updated Location',
        ];

        $response = $this->putJson('/api/holiday/' . $holiday->id, $data);
        $this->assertTrue($response->isSuccessful());

        $response->assertJsonStructure([
            'message',
            'data' => [
                'id',
                'title',
                'description',
                'date',
                'location',
                'created_by',
                'updated_by'
            ],
        ]);

        $this->assertDatabaseHas('holiday', [
            'id' => $holiday->id,
            'title' => $data['title'],
            'description' => $data['description'],
            'date' => $data['date'],
            'location' => $data['location'],
            'updated_by' => $user->id,
        ]);
    }

    public function testDeleteHoliday()
    {
        $user = User::factory()->create();

        Passport::actingAs(
            $user,
            ['delete-holidays']
        );

        $holiday = Holiday::create([
            'title' => 'Test Title',
            'description' => 'Test Description',
            'date' => '2024-12-24',
            'location' => 'Test Location',
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $response = $this->deleteJson('/api/holiday/' . $holiday->id);

        $this->assertTrue($response->isSuccessful());

        $response->assertJson([
            'message' => 'Holiday deleted successfully',
        ]);

        $this->assertDatabaseMissing('holiday', [
            'id' => $holiday->id
        ]);
    }

    public function testPdfGenerator()
    {
        $user = User::factory()->create();

        Passport::actingAs(
            $user,
            ['pdf-holidays']
        );

        $holiday = Holiday::create([
            'title' => 'Test Title',
            'description' => 'Test Description',
            'date' => '2024-12-24',
            'location' => 'Test Location',
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $response = $this->getJson('/api/holiday/' . $holiday->id . '/pdf');
        $this->assertTrue($response->isSuccessful());

        $response->assertHeader('Content-Type', 'application/pdf');

        $this->assertFileExists(public_path('pdf-holiday'));
    }
}
