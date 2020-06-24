<?php declare(strict_types=1);

namespace RobotCleaning\src;

/**
 * Interface cleanable
 */
interface Cleanable
{    
    /**
     * clean
     *
     * @return void
     */
    public function clean() : void;
}