<?php

namespace App\Helpers;

class FakeUsername
{
    public static function generate(int $minLength = 5, int $maxLength = 32): string
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_';
        $username = '';

        $length = mt_rand($minLength, $maxLength);

        while (strlen($username) < $length) {
            $randomIndex = mt_rand(0, strlen($characters) - 1);
            $username .= $characters[$randomIndex];
        }

        return $username;
    }
}