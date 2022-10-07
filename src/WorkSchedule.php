<?php

namespace Fmeccanici\Dlvr;

use Carbon\CarbonImmutable;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class WorkSchedule
{
    protected WorkWeek $workWeek;
    protected Collection $holidays;
    protected Collection $irregularWorkDays;

    public function __construct(WorkWeek $workWeek)
    {
        $this->workWeek = $workWeek;
        $this->irregularWorkDays = collect();
        $this->holidays = collect();
    }

    public function workWeek(): WorkWeek
    {
        return $this->workWeek;
    }

    public function workDay(int $year, int $month, int $day): WorkDay|IrregularWorkDay|null
    {
        $dateTime = CarbonImmutable::create($year, $month, $day);
        $dayOfWeek = $dateTime->dayOfWeek;
        $irregularWorkDay = $this->irregularWorkDayAt($dateTime);

        if ($irregularWorkDay !== null)
        {
            return $irregularWorkDay;
        }

        return $this->workWeek->workDayAt($dayOfWeek);
    }

    public function addHoliday(CarbonImmutable $date): WorkSchedule
    {
        $this->holidays->push($date);
        return $this;
    }

    public function addIrregularWorkDay(WorkHours $workHours, CarbonImmutable $date): WorkSchedule
    {
        $this->irregularWorkDays->add(new IrregularWorkDay($date, $workHours));

        return $this;
    }

    public function irregularWorkDayAt(CarbonImmutable $date): ?IrregularWorkDay
    {
        return $this->irregularWorkDays->filter(function (IrregularWorkDay $irregularWorkDay) use ($date) {
            return $irregularWorkDay->date()->isSameDay($date);
        })->first();
    }

    public function dueDate(CarbonImmutable $startDate, int $workDays): CarbonImmutable
    {
        $dueDate = clone $startDate;

        for ($i = 0; $i < $workDays; $i++)
        {
            $dueDate = $dueDate->addDay();
        }

        $workDay = $this->workWeek->workDayAt($dueDate->dayOfWeek);

        return $dueDate->setHour($workDay->startOfDay()->hours())
                ->setMinute($workDay->startOfDay()->minutes());
    }

    protected function nextWorkDay(CarbonImmutable $date): WorkDay
    {

    }
}