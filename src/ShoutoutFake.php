<?php

declare(strict_types=1);

namespace BinaryCats\Shoutout;

use InvalidArgumentException;
use LogicException;

class ShoutoutFake extends Shoutout
{
    /**
     * Valid method names that can have expectations set.
     */
    private const VALID_METHODS = ['random', 'success', 'info', 'warning', 'danger', 'error'];

    /**
     * The expectations for method returns.
     *
     * @var array<string, string>
     */
    protected array $expectations = [];

    /**
     * The method currently being configured.
     */
    protected ?string $pendingMethod = null;

    /**
     * Get a random title using the default type or the expected value.
     */
    public function random(): string
    {
        return $this->resolve('random');
    }

    /**
     * Get a random success title or the expected value.
     */
    public function success(): string
    {
        return $this->resolve('success');
    }

    /**
     * Get a random info title or the expected value.
     */
    public function info(): string
    {
        return $this->resolve('info');
    }

    /**
     * Get a random warning title or the expected value.
     */
    public function warning(): string
    {
        return $this->resolve('warning');
    }

    /**
     * Get a random danger title or the expected value.
     */
    public function danger(): string
    {
        return $this->resolve('danger');
    }

    /**
     * Get a random error title or the expected value.
     */
    public function error(): string
    {
        return $this->resolve('error');
    }

    /**
     * Begin setting an expectation for a method.
     *
     * @throws InvalidArgumentException
     */
    public function expect(string $method): self
    {
        if (! in_array($method, self::VALID_METHODS, true)) {
            throw new InvalidArgumentException(
                "Invalid method '{$method}'. Valid methods are: ".implode(', ', self::VALID_METHODS)
            );
        }

        $this->pendingMethod = $method;

        return $this;
    }

    /**
     * Set the return value for the pending expectation.
     *
     * @throws LogicException
     */
    public function andReturn(string $value): self
    {
        if ($this->pendingMethod === null) {
            throw new LogicException('Cannot call andReturn() without first calling expect()');
        }

        $this->expectations[$this->pendingMethod] = $value;
        $this->pendingMethod = null;

        return $this;
    }

    /**
     * Reset all expectations.
     */
    public function reset(): self
    {
        $this->expectations = [];
        $this->pendingMethod = null;

        return $this;
    }

    /**
     * Resolve the value for the given method.
     */
    protected function resolve(string $method): string
    {
        if (array_key_exists($method, $this->expectations)) {
            return $this->expectations[$method];
        }

        // For 'random', call parent::random() which uses the default type
        if ($method === 'random') {
            return parent::random();
        }

        return $this->fromType($method);
    }
}
