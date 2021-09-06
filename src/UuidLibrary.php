<?php

namespace Iggyvolz\Uuiddb;

use Ramsey\Uuid\UuidInterface;

abstract class UuidLibrary
{
    public abstract function get(UuidInterface $uuid, ?string $expectedType = null): ?object;
    public abstract function getPriority(): int;
    public final function register(): void
    {
        UuidDb::register($this);
    }
}