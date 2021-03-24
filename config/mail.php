<?php

return [

    'driver' => env('MAIL_DRIVER', 'smtp'),
    'host' => env('MAIL_HOST', 'smtp.gmail.com'),
    'port' => env('MAIL_PORT', 587),
    'from' => [
        'address' => 'hello@example.com',
        'name' => 'Example',
    ],
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'username' => 'testit.qq.11@gmail.com',
    'password' => '#Test@QQ@11',
    'sendmail' => '/usr/sbin/sendmail -bs',

];
