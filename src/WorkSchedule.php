<?php

namespace Fmeccanici\Dlvr;

use Carbon\CarbonImmutable;
use Fmeccanici\Dlvr\Exceptions\WorkScheduleOperationException;
use Fmeccanici\Dlvr\WorkDays\IrregularWorkDay;
use Fmeccanici\Dlvr\WorkDays\Time;
use Fmeccanici\Dlvr\WorkDays\WorkDay;
use Fmeccanici\Dlvr\WorkDays\WorkHours;
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

        $holiday = $this->holidays->first(function (CarbonImmutable $holiday) use ($dateTime) {
            return $holiday->isSameDay($dateTime);
        });

        if ($holiday !== null)
        {
            return null;
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

    public function deliveryDate(CarbonImmutable $startDate, int $workDays): CarbonImmutable
    {
        return $this->nextNthWorkDay($startDate, $workDays);
    }

    /**
     * @throws WorkScheduleOperationException
     */
    public function beforeWorkHours(CarbonImmutable $dateTime): bool
    {
        $workDay = $this->workDay($dateTime->year, $dateTime->month, $dateTime->day);

        if ($workDay === null)
        {
            throw new WorkScheduleOperationException(sprintf("Cannot determine before work hours: %s is not a workday", $dateTime->toDateTimeString()));
        }

        return $workDay->workHours()->before(new Time($dateTime->hour, $dateTime->minute));
    }

    /**
     * @throws WorkScheduleOperationException
     */
    public function afterWorkHours(CarbonImmutable $dateTime): bool
    {
        $workDay = $this->workDay($dateTime->year, $dateTime->month, $dateTime->day);

        if ($workDay === null)
        {
            throw new WorkScheduleOperationException(sprintf("Cannot determine after work hours: %s is not a workday", $dateTime->toDateTimeString()));
        }

        return $workDay->workHours()->after(new Time($dateTime->hour, $dateTime->minute));
    }

    protected function working(CarbonImmutable $dateTime): bool
    {
        $workDay = $this->workDay($dateTime->year, $dateTime->month, $dateTime->day);

        if ($workDay === null)
        {
            return false;
        }

        return ! $workDay->workHours()->outside(new Time($dateTime->hour, $dateTime->minute));
    }

    public function duringWorkHours(CarbonImmutable $dateTime): bool
    {
        $workDay = $this->workDay($dateTime->year, $dateTime->minute, $dateTime->day);

        if ($workDay === null)
        {
            return false;
        }

        return ! $workDay->workHours()->inside(new Time($dateTime->hour, $dateTime->minute));
    }

    /**
     * @throws WorkScheduleOperationException
     */
    protected function nextNthWorkDay(CarbonImmutable $start, int $n): CarbonImmutable
    {
        $nextNthWorkDay = clone $start;
        $temp = clone $start;

        if (! $this->workDay($start->year, $start->month, $start->day))
        {
            $temp = $this->nextWorkDay($nextNthWorkDay);
        } else if ($this->afterWorkHours($start))
        {
            $temp = $this->nextWorkDay($nextNthWorkDay);
        }

        for ($i = 0; $i < $n; $i++)
        {
            $nextNthWorkDay = $this->nextWorkDay($temp);
            $temp = clone $nextNthWorkDay;
        }

        return $nextNthWorkDay;
    }

    protected function nextWorkDay(CarbonImmutable $start): CarbonImmutable
    {
        $nextWorkDay = clone $start;

        if ($this->working($nextWorkDay))
        {
            $nextWorkDay = $nextWorkDay->addDay();
        }

        while (! $this->workDay($nextWorkDay->year, $nextWorkDay->month, $nextWorkDay->day))
        {
            $nextWorkDay = $nextWorkDay->addDay();
        }

        $workDay = $this->workDay($nextWorkDay->year, $nextWorkDay->month, $nextWorkDay->day);

        return $nextWorkDay
            ->startOfDay()
            ->setHour($workDay->workHours()->from()->hours())
            ->setMinute($workDay->workHours()->from()->minutes());
    }
}