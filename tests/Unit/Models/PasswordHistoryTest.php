<?php


namespace Unit\Models;

use App\Models\Password;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PasswordHistoryTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    public function testPasswordUpdatePutHistorySuccessfully() {
        /** @var Password $password */
        $password = Password::factory()->create();

        // store history
        $passwordHistory = $password->putCurrentPasswordAsHistory();

        $this->assertDatabaseHas('password_histories', [
            'id' => $passwordHistory->id,
            'password_id' => $password->id,
            'password' => $passwordHistory->password,
            'salt' => $passwordHistory->salt
        ]);

        $this->assertNotNull($passwordHistory);
    }
}
