<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Message Type
    |--------------------------------------------------------------------------
    |
    | The default message type to use when calling Shoutout::random() without
    | specifying a type. Supported: "info", "success", "warning", "danger", "error"
    |
    */

    'default' => 'info',

    /*
    |--------------------------------------------------------------------------
    | Messages
    |--------------------------------------------------------------------------
    |
    | These titles will be randomly selected for toast notifications based
    | on their type. Feel free to customize these to match your app's tone.
    |
    */

    'messages' => [
        'info' => [
            'Just so you know...',
            'A quick heads-up',
            'No alarms, just info',
            'Keeping you in the loop',
            'For your consideration',
            'Minor detail, major impact',
            'Logged and loaded',
            'Nothing urgent',
            'All part of the plan',
            'Thought you might like to know',
            'Friendly little update',
        ],
        'success' => [
            'Achievement unlocked!',
            'Flawless execution',
            'Great success!',
            'Huzzah!',
            'Like a boss',
            'Nice!',
            'Smooth as butter!',
            'That\'s how it\'s done!',
            'Very nice!',
            'Victory dance initiated',
            'We made it!',
            'Well done!',
        ],
        'warning' => [
            'Watch out',
            'Careful now',
            'Hmm...',
            'Warning',
            'Hold up',
            'Attention',
            'Heads up',
        ],
        'danger' => [
            'Oh well',
            'Not good',
        ],
        'error' => [
            'Oops',
            'Oh no',
            'Yikes',
            'Error',
            'So sad',
            'Uh oh!',
        ],
    ],
];
