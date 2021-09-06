<?php

namespace Iggyvolz\Uuiddb;

use Ramsey\Uuid\UuidInterface;

class UuidDb
{
    /**
     * @var UuidLibrary[] $libraries
     */
    private static array $libraries = [];
    private function __construct()
    {
    }
    public static function get(UuidInterface $uuid, ?string $expectedType = null): ?object
    {
        foreach(self::$libraries as $library) {
            if(is_object($val = $library->get($uuid, $expectedType))) {
                return $val;
            }
        }
        return null;
    }
    public static function register(UuidLibrary $library): void
    {
        if(in_array($library, self::$libraries)) return;
        self::$libraries[] = $library;
        usort(self::$libraries, fn(UuidLibrary $library1, UuidLibrary $library2): int => $library1->getPriority() <=> $library2->getPriority());
    }
}