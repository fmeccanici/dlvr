<?php

namespace Fmeccanici\Dlvr;

use Carbon\CarbonImmutable;

class IrregularWorkDay extends WorkDay
{
    protected CarbonImmutable $date;
    protected WorkHours $workHours;

    /**
     * @param CarbonImmutable $date
     * @param WorkHours $workHours
     */
    public function __construct(CarbonImmutable $date, WorkHours $workHours)
    {
        $this->date = $date;
        parent::__construct($workHours);
    }

    public function date(): CarbonImmutable
    {
        return $this->date;
    }

    public function workHours(): WorkHours
    {
        return $this->workHours;
    }

    function dayOfWeek(): int
    {
        return $this->date->dayOfWeek;
    }
}