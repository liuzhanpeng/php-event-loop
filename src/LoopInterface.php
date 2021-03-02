<?php

namespace Lzpeng\EventLoop;

/**
 * Event Loop Interface
 * 
 * @author lzpeng <liuzhanpeng@gmail.com>
 */
interface LoopInterface
{
    /**
     * 可读流监听
     * 监听可读流是否已准备，准备后执行对应监听处理器
     *
     * @param resource $stream 待监听的读流
     * @param callable $listener 触发的监听处理器
     * @return void
     * @throws Exception
     */
    public function onReadableStream($stream, callable $listener);

    /**
     * 可写流监听
     * 监听可写流是否已准备，准备后执行对应监听处理器
     *
     * @param resource $stream 待监听的读流
     * @param callable $listener 触发的监听处理器
     * @return void
     * @throws Exception
     */
    public function onWriteableStream($stream, callable $listener);

    /**
     * 运行事件循环
     *
     * @return void
     */
    public function run();

    /**
     * 停止事件循环
     *
     * @return void
     */
    public function stop();
}
