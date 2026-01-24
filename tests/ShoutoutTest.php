<?php

declare(strict_types=1);

use BinaryCats\Shoutout\Facades\Shoutout;
use BinaryCats\Shoutout\Shoutout as ShoutoutInstance;
use BinaryCats\Shoutout\ShoutoutFake;

describe('Shoutout', function () {

    it('returns a string from success config', function () {
        $result = Shoutout::success();

        expect($result)->toBeString();
        expect($result)->toBeIn(config('shoutout.messages.success'));
    });

    it('returns a string from info config', function () {
        $result = Shoutout::info();

        expect($result)->toBeString();
        expect($result)->toBeIn(config('shoutout.messages.info'));
    });

    it('returns a string from warning config', function () {
        $result = Shoutout::warning();

        expect($result)->toBeString();
        expect($result)->toBeIn(config('shoutout.messages.warning'));
    });

    it('returns a string from danger config', function () {
        $result = Shoutout::danger();

        expect($result)->toBeString();
        expect($result)->toBeIn(config('shoutout.messages.danger'));
    });

    it('returns a string from error config', function () {
        $result = Shoutout::error();

        expect($result)->toBeString();
        expect($result)->toBeIn(config('shoutout.messages.error'));
    });

    it('returns a string from default type when calling random()', function () {
        $result = Shoutout::random();

        expect($result)->toBeString();
        // Default is 'info', so should be from info messages
        expect($result)->toBeIn(config('shoutout.messages.info'));
    });

    it('respects custom default type for random()', function () {
        config(['shoutout.default' => 'success']);

        $result = Shoutout::random();

        expect($result)->toBeIn(config('shoutout.messages.success'));
    });

});

describe('Shoutout Fake', function () {

    it('returns a ShoutoutFake instance when fake() is called', function () {
        $fake = Shoutout::fake();

        expect($fake)->toBeInstanceOf(ShoutoutFake::class);
    });

    it('replaces the container binding with the fake', function () {
        Shoutout::fake();

        $resolved = app(ShoutoutInstance::class);

        expect($resolved)->toBeInstanceOf(ShoutoutFake::class);
    });

    it('returns expected value when expectation is set for success', function () {
        $fake = Shoutout::fake();
        $fake->expect('success')->andReturn('Expected Success');

        $result = Shoutout::success();

        expect($result)->toBe('Expected Success');
    });

    it('returns expected value when expectation is set for info', function () {
        $fake = Shoutout::fake();
        $fake->expect('info')->andReturn('Expected Info');

        $result = Shoutout::info();

        expect($result)->toBe('Expected Info');
    });

    it('returns expected value when expectation is set for warning', function () {
        $fake = Shoutout::fake();
        $fake->expect('warning')->andReturn('Expected Warning');

        $result = Shoutout::warning();

        expect($result)->toBe('Expected Warning');
    });

    it('returns expected value when expectation is set for danger', function () {
        $fake = Shoutout::fake();
        $fake->expect('danger')->andReturn('Expected Danger');

        $result = Shoutout::danger();

        expect($result)->toBe('Expected Danger');
    });

    it('returns expected value when expectation is set for error', function () {
        $fake = Shoutout::fake();
        $fake->expect('error')->andReturn('Expected Error');

        $result = Shoutout::error();

        expect($result)->toBe('Expected Error');
    });

    it('returns expected value when expectation is set for random', function () {
        $fake = Shoutout::fake();
        $fake->expect('random')->andReturn('Expected Random');

        $result = Shoutout::random();

        expect($result)->toBe('Expected Random');
    });

    it('allows chaining multiple expectations', function () {
        $fake = Shoutout::fake();
        $fake->expect('success')->andReturn('Chained Success')
            ->expect('info')->andReturn('Chained Info')
            ->expect('error')->andReturn('Chained Error');

        expect(Shoutout::success())->toBe('Chained Success');
        expect(Shoutout::info())->toBe('Chained Info');
        expect(Shoutout::error())->toBe('Chained Error');
    });

    it('falls back to random when no expectation is set', function () {
        $fake = Shoutout::fake();
        $fake->expect('success')->andReturn('Only Success');

        // info has no expectation, should return from config
        $result = Shoutout::info();

        expect($result)->toBeIn(config('shoutout.messages.info'));
    });

    it('falls back to parent random() when no expectation is set for random', function () {
        $fake = Shoutout::fake();
        $fake->expect('success')->andReturn('Only Success');

        // random has no expectation, should return from default type config
        $result = Shoutout::random();

        expect($result)->toBeIn(config('shoutout.messages.info'));
    });

});

describe('Shoutout Fake Validation', function () {

    it('throws exception for invalid method name in expect()', function () {
        $fake = Shoutout::fake();

        $fake->expect('invalid_method');
    })->throws(InvalidArgumentException::class, "Invalid method 'invalid_method'. Valid methods are: random, success, info, warning, danger, error");

    it('throws exception when calling andReturn() without expect()', function () {
        $fake = Shoutout::fake();

        $fake->andReturn('Some Value');
    })->throws(LogicException::class, 'Cannot call andReturn() without first calling expect()');

    it('allows overriding expectations', function () {
        $fake = Shoutout::fake();
        $fake->expect('success')->andReturn('First Value');
        $fake->expect('success')->andReturn('Second Value');

        expect(Shoutout::success())->toBe('Second Value');
    });

    it('can reset all expectations', function () {
        $fake = Shoutout::fake();
        $fake->expect('success')->andReturn('Expected Value');

        $fake->reset();

        // After reset, should fall back to config
        expect(Shoutout::success())->toBeIn(config('shoutout.messages.success'));
    });

});

describe('Shoutout Helper', function () {

    it('returns random message when called without type', function () {
        $result = shoutout();

        expect($result)->toBeString();
        expect($result)->toBeIn(config('shoutout.messages.info'));
    });

    it('returns success message when called with success type', function () {
        $result = shoutout('success');

        expect($result)->toBeString();
        expect($result)->toBeIn(config('shoutout.messages.success'));
    });

    it('returns info message when called with info type', function () {
        $result = shoutout('info');

        expect($result)->toBeString();
        expect($result)->toBeIn(config('shoutout.messages.info'));
    });

    it('returns warning message when called with warning type', function () {
        $result = shoutout('warning');

        expect($result)->toBeString();
        expect($result)->toBeIn(config('shoutout.messages.warning'));
    });

    it('returns danger message when called with danger type', function () {
        $result = shoutout('danger');

        expect($result)->toBeString();
        expect($result)->toBeIn(config('shoutout.messages.danger'));
    });

    it('returns error message when called with error type', function () {
        $result = shoutout('error');

        expect($result)->toBeString();
        expect($result)->toBeIn(config('shoutout.messages.error'));
    });

    it('falls back to random for unknown type', function () {
        $result = shoutout('unknown');

        expect($result)->toBeString();
        expect($result)->toBeIn(config('shoutout.messages.info'));
    });

});

describe('Shoutout Edge Cases', function () {

    it('returns type name when config is empty', function () {
        config(['shoutout.messages.success' => []]);

        $shoutout = new ShoutoutInstance;
        $result = $shoutout->success();

        expect($result)->toBe('Success');
    });

    it('returns capitalized type name for empty error config', function () {
        config(['shoutout.messages.error' => []]);

        $shoutout = new ShoutoutInstance;
        $result = $shoutout->error();

        expect($result)->toBe('Error');
    });

});
