<?php

namespace App\Helpers;

use Hashids\Hashids;

class HashidsHelper
{
    protected static $hashids;

    public static function init($salt = null, $minLength = 8, $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890')
    {
        if (!self::$hashids) {
            $salt = $salt ?? env('HASHIDS_SALT', config('app.key'));
            self::$hashids = new Hashids($salt, $minLength, $alphabet);
        }
    }

    public static function encode($id)
    {
        self::init();
        return self::$hashids->encode($id);
    }

    public static function decode($hash)
    {
        self::init();
        $decoded = self::$hashids->decode($hash);
        return $decoded[0] ?? null;
    }
}