<?php

namespace Fmeccanici\Dlvr;

use Illuminate\Contracts\Support\Arrayable;

class Time implements Arrayable
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

    public function hours(): int
    {
        return $this->hours;
    }

    public function minutes(): int
    {
        return $this->minutes;
    }

    public function isAfter(Time $other): bool
    {
        if ($this->hours > $other->hours)
        {
            return true;
        }

        return $this->minutes > $other->minutes;
    }

    public function isBefore(Time $other): bool
    {
        if ($this->hours < $other->hours)
        {
            return true;
        }

        return $this->minutes < $other->minutes;
    }

    public function toArray()
    {
        return [
            'hours' => $this->hours,
            'minutes' => $this->minutes,
            'seconds' => $this->seconds
        ];
    }
}