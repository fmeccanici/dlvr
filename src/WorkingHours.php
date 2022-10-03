<?php

namespace Fmeccanici\Dlvr;

class WorkingHours
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
}