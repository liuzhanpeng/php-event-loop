<?php

namespace Lzpeng\EventLoop\Loop;

use Lzpeng\EventLoop\LoopInterface;

class StreamSelect implements LoopInterface
{
    private $readStreams = [];
    private $writeStreams = [];
    private $readListeners = [];
    private $writeListeners = [];
    private $isRunning = true;

    public function __construct()
    {
    }

    public function onReadableStream($stream, callable $listener)
    {
        $this->readStreams[(int) $stream] = $stream;
        $this->readListeners[(int) $stream] = $listener;
    }

    public function onWriteableStream($stream, callable $listener)
    {
        $this->writeStreams[(int) $stream] = $stream;
        $this->writeListeners[(int) $stream] = $listener;
    }

    public function run()
    {
        while ($this->isRunning) {
            $reads = $this->readStreams;
            $writes = $this->writeStreams;
            $except = [];

            if ($reads || $writes) {
                $ret = @stream_select($reads, $writes, $except, null);
                if ($ret === false) {
                } elseif ($ret > 0) {
                    foreach ($reads as $stream) {
                        $key = (int) $stream;
                        if (isset($this->readListeners[$key])) {
                            call_user_func($this->readListeners[$key], $stream);
                        }
                    }
                    foreach ($writes as $stream) {
                        $key = (int) $stream;
                        if (isset($this->writeListeners[$key])) {
                            call_user_func($this->writeListeners[$key], $stream);
                        }
                    }
                }
            }
        }
    }

    public function stop()
    {
        $this->isRunning = false;
    }
}
