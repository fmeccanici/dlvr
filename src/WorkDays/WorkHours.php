<?php

namespace Fmeccanici\Dlvr\WorkDays;

use Illuminate\Contracts\Support\Arrayable;

class WorkHours implements Arrayable
{
    protected Time $from;
    protected Time $to;

    /**
     * @param Time $from
     * @param Time $to
     */
    public function __construct(Time $from, Time $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function from(): Time
    {
        return $this->from;
    }

    public function to(): Time
    {
        return $this->to;
    }

    public function outside(Time $time): bool
    {
        return $time->isAfter($this->to) && $time->isBefore($this->from);
    }

    public function inside(Time $time): bool
    {
        return $time->isBefore($this->to) && $time->isAfter($this->from);
    }

    public function before(Time $time): bool
    {
        return $time->isBefore($this->from);
    }

    public function after(Time $time): bool
    {
        return $time->isAfter($this->to);
    }

    public function toArray()
    {
        return [
            'from' => $this->from->toArray(),
            'to' => $this->to->toArray()
        ];
    }
}