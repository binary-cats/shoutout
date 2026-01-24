<?php

arch('it will not use debugging functions')
    ->expect(['dd', 'dump', 'ray'])
    ->each->not->toBeUsed();

arch('strict types are declared in all source files')
    ->expect('BinaryCats\Shoutout')
    ->toUseStrictTypes();

arch('shoutout class is final or extendable by design')
    ->expect('BinaryCats\Shoutout\Shoutout')
    ->toBeClasses();

arch('facades extend base facade')
    ->expect('BinaryCats\Shoutout\Facades')
    ->toExtend('Illuminate\Support\Facades\Facade');
