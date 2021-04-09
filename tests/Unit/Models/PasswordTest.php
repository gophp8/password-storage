<?php


namespace Unit\Models;

use App\Libraries\Hashing;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Password;

/**
 * Class PasswordTest
 * @package Unit\Models
 * @coversDefaultClass \App\Models\Password
 */
class PasswordTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    /**
     * @test
     * @covers ::setPasswordAttribute
     */
    public function testSetRawPasswordSavedEncryptedPassword() {
        $rawPassword = $this->faker->password;
        $password = new Password([
            'password' => $rawPassword
        ]);

        $this->assertNotSame($rawPassword, $password->password);
        $this->assertNotEmpty($password->salt);
    }

    /**
     * @test
     */
    public function testCreateNewPasswordSuccessfully()
    {
        $password = Password::factory()->create();
        $this->assertNotEmpty($password->password);
        $this->assertNotEmpty($password->salt);
    }

    /**
     * @test
     * @covers ::getRawPasswordAttribute
     */
    public function testGetRawPasswordSuccessfully() {
        $rawPassword = $this->faker->password;
        $password = Password::factory()->create();
        $password->password = $rawPassword;
        $password->save();

        $this->assertNotEmpty($password->password);
        $this->assertNotEmpty($password->salt);
        $this->assertEquals($rawPassword, $password->rawPassword);
    }
}
