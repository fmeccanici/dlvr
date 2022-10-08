<?php

namespace Fmeccanici\Dlvr\Builders;

use Carbon\CarbonImmutable;
use Fmeccanici\Dlvr\DayOfWeek;
use Fmeccanici\Dlvr\WorkDays\RegularWorkDay;
use Fmeccanici\Dlvr\WorkDays\Time;
use Fmeccanici\Dlvr\WorkDays\WorkHours;
use Fmeccanici\Dlvr\WorkSchedule;
use Fmeccanici\Dlvr\WorkWeek;

class WorkScheduleBuilder implements WorkScheduleBuilderInterface
{
    private WorkSchedule $workSchedule;

    public function __construct()
    {
        $this->workSchedule = new WorkSchedule(new WorkWeek());
    }

    public function addRegularWorkDay(int $dayOfWeek, int $startHour, int $startMinute, int $endHour, int $endMinute): WorkScheduleBuilder
    {
        $workDay = new RegularWorkDay($dayOfWeek, new WorkHours(new Time($startHour, $startMinute), new Time($endHour, $endMinute)));
        $this->workSchedule->workWeek()->setWorkDay($workDay);
        return $this;
    }

    public function addHoliday(CarbonImmutable $date): WorkScheduleBuilder
    {
        $this->workSchedule->addHoliday($date);

        return $this;
    }

    public function addDeviatingWorkHours(CarbonImmutable $date, int $startHour, int $startMinute, int $endHour, int $endMinute): WorkScheduleBuilder
    {
        $workHours = new WorkHours(new Time($startHour, $startMinute), new Time($endHour, $endMinute));
        $this->workSchedule->addIrregularWorkDay($workHours, $date);

        return $this;

    }

    public function build(): WorkSchedule
    {
        return $this->workSchedule;
    }

    public function addRegularWorkWeek(): WorkScheduleBuilder
    {
        $this->addRegularWorkDay(DayOfWeek::MONDAY, 9, 0, 17, 0);
        $this->addRegularWorkDay(DayOfWeek::TUESDAY, 9, 0, 17, 0);
        $this->addRegularWorkDay(DayOfWeek::WEDNESDAY, 9, 0, 17, 0);
        $this->addRegularWorkDay(DayOfWeek::THURSDAY, 9, 0, 17, 0);
        $this->addRegularWorkDay(DayOfWeek::FRIDAY, 9, 0, 17, 0);
        return $this;
    }
}