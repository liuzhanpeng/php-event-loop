<?php

namespace Lzpeng\EventLoop;

use Lzpeng\EventLoop\Loop\StreamSelect;

final class Factory
{
    private function __construct()
    {
    }

    public static function create(): LoopInterface
    {
        return new StreamSelect();
    }
}
