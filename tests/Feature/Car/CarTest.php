<?php

namespace Tests\Feature\Car;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Car;
use App\Models\Transaction;

class CarTest extends TestCase
{
    private $token;
    protected function setUp(): void
    {
        parent::setUp();
        User::truncate();
        Car::truncate();
        $user = User::factory()->create(['password' => bcrypt('heri')]);
        $this->token = \JWTAuth::fromUser($user);
    }

    public function test_get_all_car(){
        Car::factory(20)->create();
        $response = $this->get('api/car', [
            'HTTP_Authorization' => 'Bearer ' . $this->token
        ]);
        $response->assertStatus(200);
        $response->assertJsonCount(20, 'data');
    }

    public function test_input_car(){
        $response = $this->post('api/car', [
            'name' => 'Honda',
            'release_year' => 2020,
            'color' => 'red',
            'price' => 125000000,
            'engine' => 'Cora',
            'seats' => 4,
            'type' => 'Civic',
            'stock' => 20
        ],[
            'HTTP_Authorization' => 'Bearer ' . $this->token
        ]);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => [
                'name'
            ]
        ]);
    }

    public function test_car_sold(){
        $car = Car::factory()->create(['stock' => 50]);
        $response = $this->post('api/car/sold', [
            'car_id' => $car->_id,
            'buyer_name' => 'Dimas',
            'unit' => 20
        ],[
            'HTTP_Authorization' => 'Bearer ' . $this->token
        ]);
        $response->assertJsonStructure([
            "message",
            "data"
        ]);
    }

    public function test_check_stock(){
        $car = Car::factory()->create(['stock' => 50]);
        $response = $this->get(route('api::car::stock', [
            'id' => $car->_id,
        ]),[
            'HTTP_Authorization' => 'Bearer ' . $this->token
        ]);
        $response->assertJson([
            'data' => [
                'stock' => $car->stock
            ]
        ]);
    }

    public function test_check_transaction(){
        $car = Car::factory()->create(['stock' => 50]);
        Transaction::factory(5)->create([
            'vehicle_id' => $car->_id,
            'type' => 'car'
        ]);
        $response = $this->get(route('api::car::transaction', [
            'id' => $car->_id,
        ]),[
            'HTTP_Authorization' => 'Bearer ' . $this->token
        ]);
        $response->assertJsonStructure([
            'data' => [
                'transactions'
            ]
        ]);
    }
}
