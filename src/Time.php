<?php

namespace Fmeccanici\Dlvr;

class Time
{
    protected int $hours;
    protected int $minutes;
    protected int $seconds;

    /**
     * @param int $hours
     * @param int $minutes
     * @param int $seconds
     */
    public function __construct(int $hours, int $minutes, int $seconds = 0)
    {
        $this->hours = $hours;
        $this->minutes = $minutes;
        $this->seconds = $seconds;
    }
}