<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_show()
    {
        $response = $this->get('api/users/1');

        $response->assertStatus(200)
            ->assertJson([
                "id" => 1,
                "name" => "Felipe",
                "email" => "felipebuitragocarmona@gmail.com",
                "email_verified_at" => null,
                "created_at" => null,
                "updated_at" => null,
                "role_id" => 1,
                "profile" => [
                    "id" => 1,
                    "phone_number" => "3116665544",
                    "url_instagram" => "asdasdad",
                    "created_at" => null,
                    "updated_at" => null,
                    "user_id" => 1
                ],
                "role" => [
                    "id" => 1,
                    "name" => "Administrador",
                    "created_at" => null,
                    "updated_at" => null
                ]
            ]);
    }
    public function test_show2()
    {
        $response = $this->get('api/users/1000');

        $response->assertStatus(404)
            ->assertJson([
                "message" => "Not found"
            ]);
    }
    public function test_index()
    {
        $response = $this->get('api/users');

        $response->assertStatus(200)
            ->assertJson([
                [
                    "id"=> 1,
                    "name"=> "Felipe",
                    "email"=> "felipebuitragocarmona@gmail.com",
                    "email_verified_at"=> null,
                    "created_at"=> null,
                    "updated_at"=> null,
                    "role_id"=> 1
                ],
                [
                    "id"=> 2,
                    "name"=> "Lucas",
                    "email"=> "lucas@email.com",
                    "email_verified_at"=> null,
                    "created_at"=> "2022-09-24T18:19:10.000000Z",
                    "updated_at"=> "2022-09-24T18:19:10.000000Z",
                    "role_id"=> 1
                
            ]]);
    }
}
