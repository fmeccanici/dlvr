<?php

namespace Fmeccanici\Dlvr;

use Fmeccanici\Dlvr\Exceptions\InvalidDayOfWeekException;

class WorkWeek
{
    protected ?WorkDay $monday;
    protected ?WorkDay $tuesday;
    protected ?WorkDay $wednesday;
    protected ?WorkDay $thursday;
    protected ?WorkDay $friday;
    protected ?WorkDay $saturday;
    protected ?WorkDay $sunday;

    public function __construct(?WorkDay $monday,
                                ?WorkDay $tuesday,
                                ?WorkDay $wednesday,
                                ?WorkDay $thursday,
                                ?WorkDay $friday,
                                ?WorkDay $saturday = null,
                                ?WorkDay $sunday = null)
    {
        $this->monday = $monday;
        $this->tuesday = $tuesday;
        $this->wednesday = $wednesday;
        $this->thursday = $thursday;
        $this->friday = $friday;
        $this->saturday = $saturday;
        $this->sunday = $sunday;
    }

    public function setWorkDay(WorkDay $workDay): WorkWeek
    {
        $existingWorkDay = &$this->workDay($workDay->dayOfWeek());
        $workDayTemp = &$existingWorkDay;
        $workDayTemp = $workDay;
        return $this;
    }

    public function workDayAt(int $dayOfWeek): ?WorkDay
    {
        return $this->workDay($dayOfWeek);
    }

    public function monday(): ?WorkDay
    {
        return $this->monday;
    }

    public function removeWorkDay(int $dayOfWeek): WorkWeek
    {
        $existingWorkDay = &$this->workDay($dayOfWeek);
        $workDayTemp = &$existingWorkDay;
        $workDayTemp = null;
        return $this;
    }

    /**
     * @throws InvalidDayOfWeekException
     */
    protected function &workDay(int $dayOfWeek): ?WorkDay
    {
        if ($dayOfWeek === DayOfWeek::MONDAY)
        {
            return $this->monday;
        } else if ($dayOfWeek === DayOfWeek::TUESDAY)
        {
            return $this->tuesday;
        } else if ($dayOfWeek === DayOfWeek::WEDNESDAY)
        {
            return $this->wednesday;
        } else if ($dayOfWeek === DayOfWeek::THURSDAY)
        {
            return $this->thursday;
        } else if ($dayOfWeek === DayOfWeek::FRIDAY)
        {
            return $this->friday;
        } else if ($dayOfWeek === DayOfWeek::SATURDAY)
        {
            return $this->saturday;
        } else if ($dayOfWeek === DayOfWeek::SUNDAY)
        {
            return $this->sunday;
        }

        throw new InvalidDayOfWeekException("Day of week ({$dayOfWeek}) should not be smaller than 0 or larger than 6");
    }

}