<?php

namespace Fmeccanici\Dlvr;

use Fmeccanici\Dlvr\Builders\WorkScheduleBuilderInterface;

class SupplyChain
{
    public static function createRegularWorkSchedule(WorkScheduleBuilderInterface $workScheduleBuilder): WorkSchedule
    {
        $workScheduleBuilder->addRegularWorkDay(DayOfWeek::MONDAY, 9, 0, 17, 0);
        $workScheduleBuilder->addRegularWorkDay(DayOfWeek::TUESDAY, 9, 0, 17, 0);
        $workScheduleBuilder->addRegularWorkDay(DayOfWeek::WEDNESDAY, 9, 0, 17, 0);
        $workScheduleBuilder->addRegularWorkDay(DayOfWeek::THURSDAY, 9, 0, 17, 0);
        $workScheduleBuilder->addRegularWorkDay(DayOfWeek::FRIDAY, 9, 0, 17, 0);
        $workScheduleBuilder->addRegularWorkDay(DayOfWeek::SATURDAY, 9, 0, 17, 0);

        return $workScheduleBuilder->build();
    }
}