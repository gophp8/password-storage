<?php

namespace App\Libraries;

use Illuminate\Support\Str;

class Hashing
{
    const HASHING_METHOD = 'aes-256-cbc';

    public static function generateSalt(): string
    {
        // generating salt
        return substr(hash('sha256', Str::random(15), true), 0, 32);
    }

    public static function getHashIV(): string
    {
        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
        return $iv;
    }

    public static function encryptPassword(string $password, string $salt): string
    {
        return base64_encode(
            openssl_encrypt(
                $password,
                Hashing::HASHING_METHOD,
                $salt,
                OPENSSL_RAW_DATA,
                Hashing::getHashIV()
            )
        );
    }

    public static function decryptPassword(string $password, string $salt): string
    {
        return openssl_decrypt(
            base64_decode($password),
            Hashing::HASHING_METHOD,
            $salt,
            OPENSSL_RAW_DATA,
            Hashing::getHashIV()
        );
    }
}
