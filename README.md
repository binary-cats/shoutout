![](https://banners.beyondco.de/Shoutout.png?theme=light&packageManager=composer+require&packageName=binary-cats%2Fshoutout&pattern=topography&style=style_1&description=Render+inspirational+toast+titles&md=1&showWatermark=1&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg)

# Shoutout

[![Latest Version on Packagist](https://img.shields.io/packagist/v/binary-cats/shoutout.svg?style=flat-square)](https://packagist.org/packages/binary-cats/shoutout)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/binary-cats/shoutout/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/binary-cats/shoutout/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/binary-cats/shoutout.svg?style=flat-square)](https://packagist.org/packages/binary-cats/shoutout)

Inspirational titles for your toasts.

Ever got stuck writing another title for your success toast? Ever got bored with "Success!" message?
Shoutout solves this for you with random configurable messages

## Installation

```bash
composer require binary-cats/shoutout
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag=shoutout-config
```

This will create `config/shoutout.php` where you can customize the titles for each notification type. This is the contents of the published config file:

```php
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

```

## Usage

Shoutout comes in two flavors. You can use a `Shoutout` facade or a `shoutout()` helper method: 

```php
use BinaryCats\Shoutout\Facades\Shoutout;

// Get a random title using the default type (configured in config)
$title = Shoutout::random();   // Uses 'info' set by default

// Get random titles by specific type
$successTitle = Shoutout::success();  // "Achievement unlocked!", "Nice!", etc.
$infoTitle = Shoutout::info();        // "Just so you know...", "A quick heads-up", etc.
$warningTitle = Shoutout::warning();  // "Watch out", "Careful now", etc.
$dangerTitle = Shoutout::danger();    // "Oh well", "Not good"
$errorTitle = Shoutout::error();      // "Oops", "Oh no", etc.
```

### Example with Toast Notifications

```php
// In a Controller
public function store(Request $request): RedirectResponse
{
    // ... save logic

    return redirect()
        ->route('posts.index')
        ->with('toast', [
            'type' => 'success',
            'title' => Shoutout::success(),
            'message' => 'Post created successfully!'
        ]);
}
```

or with [Livewire Flux](https://fluxui.dev/components/toast):
```php
    Flux::toast(
        heading: Shoutout::success(),
        text: 'Your changes have been saved.',
        variant: 'success',
    );
```

.. you get the idea.

## Testing

Shoutout provides a test fake:

```php
use BinaryCats\Shoutout\Facades\Shoutout;

public function test_it_shows_success_toast(): void
{
    Shoutout::fake()
        ->expect('success')
        ->andReturn('Test Success');

    $response = $this->post('/posts', ['title' => 'Test']);

    $response->assertSessionHas('toast.title', 'Test Success');
}
```

You can chain fake expectations:

```php
Shoutout::fake()
    ->expect('success')->andReturn('Yay!')
    ->expect('danger')->andReturn('Oh no!')
    ->expect('error')->andReturn('Failed!');
```

If no expectation is set for a method, the fake will return a random value from config (same as the real implementation).

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Cyrill N Kalita](https://github.com/cyrillkalita)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
