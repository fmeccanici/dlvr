<?php

namespace Fmeccanici\Dlvr;

use Carbon\CarbonImmutable;

class WorkSchedule
{
    protected string $companyId;
    protected WorkWeek $workWeek;

    /**
     * @param string $companyId
     * @param WorkWeek $workWeek
     */
    public function __construct(string $companyId, WorkWeek $workWeek)
    {
        $this->companyId = $companyId;
        $this->workWeek = $workWeek;
    }

    public function companyId(): string
    {
        return $this->companyId;
    }

    public function workWeek(): WorkWeek
    {
        return $this->workWeek;
    }

    public function workDay(int $year, int $month, int $day): ?WorkDay
    {
        $dateTime = CarbonImmutable::create($year, $month, $day);
        $dayOfWeek = $dateTime->dayOfWeek;
        return $this->workWeek->workDayAt($dayOfWeek);
    }
}