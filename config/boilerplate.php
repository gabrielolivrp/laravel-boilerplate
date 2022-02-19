<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Auth
    |--------------------------------------------------------------------------
    |
    | Configurations related to the boilerplate's access/authorization options
    */
    'auth' => [
        'user' => [

            /*
             * Whether or not a user can change their email address after
             * their profile has already been created
             */
            'change_email' => env('CHANGE_EMAIL', true),
        ],

        'role' => [

            /*
             * The name of the administrator role
             * Should be Administrator by design and unable to change from the admin
             * It is not recommended to change
             */
            'admin' => 'Administrator',

            /*
             * Default role
             */
            'default' => 'User',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Google Analytics
    |--------------------------------------------------------------------------
    |
    | Found in views/includes/partials/ga.blade.php
    */
    'google_analytics' => env('GOOGLE_ANALYTICS', 'UA-XXXXX-X'),

    /*
    |--------------------------------------------------------------------------
    | Avatar
    |--------------------------------------------------------------------------
    |
    | Configurations related to the boilerplate's avatar system
    */
    'avatar' => [

        /*
         * Default avatar size
         */
        'size' => 80,

        /*
         * Hex color for the font, without the hash (#)
         */
        'color' => '7F9CF5',

        /*
         * Hex color for the image background, without the hash (#)
         */
        'background' => 'EBF4FF',
    ],

    /*
    |--------------------------------------------------------------------------
    | Locale
    |--------------------------------------------------------------------------
    |
    | Configurations related to the boilerplate's locale system
    */
    'locale' => [
        /*
         * Whether or not to show the language picker, or just default to the default
         * locale specified in the app config file
         */
        'status' => true,

        /*
         * Available languages
         *
         * Add your language code to this array.
         * The code must have the same name as the language folder.
         * Be sure to add the new language in an alphabetical order.
         *
         * The language picker will not be available if there is only one language option
         * Commenting out languages will make them unavailable to the user
         */
        'languages' => [
            'ar' => ['name' => 'Arabic', 'rtl' => true],
            'az' => ['name' => 'Azerbaijan', 'rtl' => false],
            'zh' => ['name' => 'Chinese Simplified', 'rtl' => false],
            'zh-TW' => ['name' => 'Chinese Traditional', 'rtl' => false],
            'cs' => ['name' => 'Czech', 'rtl' => false],
            'da' => ['name' => 'Danish', 'rtl' => false],
            'de' => ['name' => 'German', 'rtl' => false],
            'el' => ['name' => 'Greek', 'rtl' => false],
            'en' => ['name' => 'English', 'rtl' => false],
            'es' => ['name' => 'Spanish', 'rtl' => false],
            'fa' => ['name' => 'Persian', 'rtl' => true],
            'fr' => ['name' => 'French', 'rtl' => false],
            'he' => ['name' => 'Hebrew', 'rtl' => true],
            'id' => ['name' => 'Indonesian', 'rtl' => false],
            'it' => ['name' => 'Italian', 'rtl' => false],
            'ja' => ['name' => 'Japanese', 'rtl' => false],
            'nl' => ['name' => 'Dutch', 'rtl' => false],
            'no' => ['name' => 'Norwegian', 'rtl' => false],
            'pl' => ['name' => 'Polish', 'rtl' => false],
            'pt_BR' => ['name' => 'Brazilian Portuguese', 'rtl' => false],
            'ru' => ['name' => 'Russian', 'rtl' => false],
            'sv' => ['name' => 'Swedish', 'rtl' => false],
            'th' => ['name' => 'Thai', 'rtl' => false],
            'tr' => ['name' => 'Turkish', 'rtl' => false],
            'uk' => ['name' => 'Ukrainian', 'rtl' => false],
        ],
    ],
];
