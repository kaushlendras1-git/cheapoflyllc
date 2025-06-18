<?php

return [
    'salt' => env('HASHIDS_SALT', 'default-salt-string'),
    'length' => 8,
    'alphabet' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
];
