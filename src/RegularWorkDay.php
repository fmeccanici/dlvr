<?php

namespace Fmeccanici\Dlvr;

class RegularWorkDay extends WorkDay
{
    protected int $dayOfWeek;
    protected WorkHours $workHours;

    /**
     * @param int $dayOfWeek
     * @param WorkHours $workHours
     */
    public function __construct(int $dayOfWeek, WorkHours $workHours)
    {
        $this->dayOfWeek = $dayOfWeek;
        $this->workHours = $workHours;
    }

    public function dayOfWeek(): int
    {
        return $this->dayOfWeek;
    }

    public function workHours(): WorkHours
    {
        return $this->workHours;
    }

    public function startOfDay(): Time
    {
        return $this->workHours->from();
    }

    public function endOfDay(): Time
    {
        return $this->workHours->to();
    }
}