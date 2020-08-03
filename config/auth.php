<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
        ],
        
        // For Admin
        'admin' => [
            'driver'   => 'session',
            'provider' => 'admin'
        ],
        
        // For Branch
        'branch' => [
            'driver'   => 'session',
            'provider' => 'branch'
        ],
        
        // For Telecaller
        'telecaller' => [
            'driver'   => 'session',
            'provider' => 'telecaller'
        ],
        
        // For Tpo
        'tpo' => [
            'driver'   => 'session',
            'provider' => 'tpo'
        ],
        
        // For Marketing Person
        'marketing_person' => [
            'driver'   => 'session',
            'provider' => 'marketing_person'
        ],
        
        // For Teacher
        'teacher' => [
            'driver'   => 'session',
            'provider' => 'teacher'
        ],
        
        // For Student
        'student' => [
            'driver'   => 'session',
            'provider' => 'student'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
        
        // For Admin
        'admin' => [
            'driver' => 'database',
            'model' => App\Admin::class,
            'table' => 'admin',
        ],
        
        // For Branch
        'branch' => [
            'driver' => 'database',
            'model' => App\Branch::class,
            'table' => 'branch',
        ],
        
        // For Telecaller
        'telecaller' => [
            'driver' => 'database',
            'model' => App\Telecaller::class,
            'table' => 'telecaller',
        ],
        
        // For Tpo
        'tpo' => [
            'driver' => 'database',
            'model' => App\Tpo::class,
            'table' => 'tpo',
        ],
        
        // For Marketing Person
        'marketing_person' => [
            'driver' => 'database',
            'model' => App\MarketingPerson::class,
            'table' => 'marketing_person',
        ],
        
        // For Teacher
        'teacher' => [
            'driver' => 'database',
            'model' => App\Teacher::class,
            'table' => 'teacher',
        ],
        
        // For Student
        'student' => [
            'driver' => 'database',
            'model' => App\Student::class,
            'table' => 'student',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        
        // For Admin
        'admin' => [
            'provider' => 'admin',
            'email' => 'auth.emails.password',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        
        // For Branch
        'branch' => [
            'provider' => 'branch',
            'email' => 'auth.emails.password',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        
        // For Telecaller
        'telecaller' => [
            'provider' => 'telecaller',
            'email' => 'auth.emails.password',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        
        // For Tpo
        'tpo' => [
            'provider' => 'tpo',
            'email' => 'auth.emails.password',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        
        // For Marketing Person
        'marketing_person' => [
            'provider' => 'marketing_person',
            'email' => 'auth.emails.password',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        
        // For Teacher
        'teacher' => [
            'provider' => 'teacher',
            'email' => 'auth.emails.password',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        
        // For Student
        'student' => [
            'provider' => 'student',
            'email' => 'auth.emails.password',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],

];
