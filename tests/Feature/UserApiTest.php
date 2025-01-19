<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserApiTest extends TestCase {
    public function test_can_create_user() {
        $data = ['name' => 'Dhaval Ramoliya', 'dob' => '1988-12-01', 'address' => '123 Street', 'description' => 'Test description'];
        $this->postJson('/api/users', $data)->assertCreated()->assertJson($data);
    }

    public function test_can_get_all_users() {
        User::factory()->count(3)->create();
        $this->getJson('/api/users')->assertOk()->assertJsonCount(3);
    }

    public function test_can_update_user() {
        $user = User::factory()->create();
        $data = ['name' => 'Piyush Patel'];
        $this->putJson("/api/users/{$user->id}", $data)->assertOk()->assertJson($data);
    }

    public function test_can_delete_user() {
        $user = User::factory()->create();
        $this->deleteJson("/api/users/{$user->id}")->assertNoContent();
    }
}

