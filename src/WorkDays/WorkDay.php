<?php

namespace Fmeccanici\Dlvr\WorkDays;

abstract class WorkDay
{
    protected WorkHours $workHours;

    /**
     * @param WorkHours $workHours
     */
    public function __construct(WorkHours $workHours)
    {
        $this->workHours = $workHours;
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

    abstract function dayOfWeek(): int;

}