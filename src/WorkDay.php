<?php

namespace Fmeccanici\Dlvr;

class WorkDay
{
    protected int $dayOfWeek;
    protected WorkingHours $workingHours;

    /**
     * @param int $dayOfWeek
     * @param WorkingHours $workingHours
     */
    public function __construct(int $dayOfWeek, WorkingHours $workingHours)
    {
        $this->dayOfWeek = $dayOfWeek;
        $this->workingHours = $workingHours;
    }

    public function dayOfWeek(): int
    {
        return $this->dayOfWeek;
    }
}