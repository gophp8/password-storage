<?php


namespace Unit\Libraries;

use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;
use App\Libraries\Hashing;

/**
 * Class HashingTest
 * @package Unit\Libraries
 * @coversDefaultClass \App\Libraries\Hashing
 */
class HashingTest extends TestCase
{
    /**
     * @test
     * @covers ::generateSalt
     */
    public function testGenerateSalt() {
        $salt = Hashing::generateSalt();

        $this->assertIsString($salt);
        $this->assertNotEmpty($salt);
        $this->assertSame(32, strlen($salt));
    }

    /**
     * @test
     * @covers ::encryptPassword
     */
    public function testEncryptPasswordReturnsEncryptedPassword() {
        $salt = Hashing::generateSalt();
        $password = Str::random(10);
        $encryptedPassword = Hashing::encryptPassword($password, $salt);

        $this->assertNotSame($password, $encryptedPassword);
        $this->assertIsString($encryptedPassword);
    }

    /**
     * @test
     * @covers ::encryptPassword
     */
    public function testDecryptPasswordReturnsRawPasswordAsSameAsBefore() {
        $salt = Hashing::generateSalt();
        $password = Str::random(10);
        $encryptedPassword = Hashing::encryptPassword($password, $salt);
        $decryptedPassword = Hashing::decryptPassword($encryptedPassword, $salt);

        $this->assertIsString($decryptedPassword);
        $this->assertSame($password, $decryptedPassword);
    }
}
