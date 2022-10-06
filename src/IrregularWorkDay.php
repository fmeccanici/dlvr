<?php

namespace Fmeccanici\Dlvr;

use Carbon\CarbonImmutable;

class IrregularWorkDay
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
        $this->workHours = $workHours;
    }

    public function date(): CarbonImmutable
    {
        return $this->date;
    }

    public function workHours(): WorkHours
    {
        return $this->workHours;
    }

}