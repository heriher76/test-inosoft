<?php

namespace Tests\Feature\Motorcycle;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Motorcycle;
use App\Models\Transaction;

class MotorcycleTest extends TestCase
{
    private $token;
    protected function setUp(): void
    {
        parent::setUp();
        User::truncate();
        Motorcycle::truncate();
        Transaction::truncate();
        $user = User::factory()->create(['password' => bcrypt('heri')]);
        $this->token = \JWTAuth::fromUser($user);
    }

    public function test_get_all_motorcycle(){
        Motorcycle::factory(20)->create();
        $response = $this->get('api/motorcycle', [
            'HTTP_Authorization' => 'Bearer ' . $this->token
        ]);
        $response->assertStatus(200);
        $response->assertJsonCount(20, 'data');
    }

    public function test_input_motorcycle(){
        $response = $this->post('api/motorcycle', [
            'name' => 'Honda',
            'release_year' => 2020,
            'color' => 'red',
            'price' => 125000000,
            'engine' => 'Cora',
            'suspension' => "Mora",
            'transmission' => 'Cane',
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

    public function test_motorcycle_sold(){
        $motorcycle = Motorcycle::factory()->create(['stock' => 50]);
        $response = $this->post('api/motorcycle/sold', [
            'motorcycle_id' => $motorcycle->_id,
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
        $motorcycle = Motorcycle::factory()->create(['stock' => 50]);
        $response = $this->get(route('api::motorcycle::stock', [
            'id' => $motorcycle->_id,
        ]),[
            'HTTP_Authorization' => 'Bearer ' . $this->token
        ]);
        $response->assertJson([
            'data' => [
                'stock' => $motorcycle->stock
            ]
        ]);
    }

    public function test_check_transaction(){
        $motorcycle = Motorcycle::factory()->create(['stock' => 50]);
        Transaction::factory(5)->create([
            'vehicle_id' => $motorcycle->_id,
            'type' => 'motorcycle'
        ]);
        $response = $this->get(route('api::motorcycle::transaction', [
            'id' => $motorcycle->_id,
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
