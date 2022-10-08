<?php

namespace Fmeccanici\Dlvr\Factories;

use Carbon\CarbonImmutable;
use Fmeccanici\Dlvr\DayOfWeek;
use Fmeccanici\Dlvr\WorkDays\IrregularWorkDay;
use Fmeccanici\Dlvr\WorkDays\RegularWorkDay;
use Fmeccanici\Dlvr\WorkDays\Time;
use Fmeccanici\Dlvr\WorkDays\WorkDay;
use Fmeccanici\Dlvr\WorkDays\WorkHours;

class CreateWorkDay
{
    public static function monday(int $fromHours = 9, int $fromMinutes = 0,
                                  int $toHours = 17, int $toMinutes = 0): WorkDay
    {
        return new RegularWorkDay(DayOfWeek::MONDAY,
            new WorkHours(new Time($fromHours, $fromMinutes),
            new Time($toHours, $toMinutes)));
    }

    public static function tuesday(int $fromHours = 9, int $fromMinutes = 0,
                                  int $toHours = 17, int $toMinutes = 0): WorkDay
    {
        return new RegularWorkDay(DayOfWeek::TUESDAY,
            new WorkHours(new Time($fromHours, $fromMinutes),
                new Time($toHours, $toMinutes)));
    }

    public static function wednesday(int $fromHours = 9, int $fromMinutes = 0,
                                  int $toHours = 17, int $toMinutes = 0): WorkDay
    {
        return new RegularWorkDay(DayOfWeek::WEDNESDAY,
            new WorkHours(new Time($fromHours, $fromMinutes),
                new Time($toHours, $toMinutes)));
    }

    public static function thursday(int $fromHours = 9, int $fromMinutes = 0,
                                    int $toHours = 17, int $toMinutes = 0): WorkDay
    {
        return new RegularWorkDay(DayOfWeek::THURSDAY,
            new WorkHours(new Time($fromHours, $fromMinutes),
                new Time($toHours, $toMinutes)));
    }

    public static function friday(int $fromHours = 9, int $fromMinutes = 0,
                                    int $toHours = 17, int $toMinutes = 0): WorkDay
    {
        return new RegularWorkDay(DayOfWeek::FRIDAY,
            new WorkHours(new Time($fromHours, $fromMinutes),
                new Time($toHours, $toMinutes)));
    }

    public static function saturday(int $fromHours = 9, int $fromMinutes = 0,
                                    int $toHours = 17, int $toMinutes = 0): WorkDay
    {
        return new RegularWorkDay(DayOfWeek::SATURDAY,
            new WorkHours(new Time($fromHours, $fromMinutes),
                new Time($toHours, $toMinutes)));
    }

    public static function sunday(int $fromHours = 9, int $fromMinutes = 0,
                                    int $toHours = 17, int $toMinutes = 0): WorkDay
    {
        return new RegularWorkDay(DayOfWeek::SUNDAY,
            new WorkHours(new Time($fromHours, $fromMinutes),
                new Time($toHours, $toMinutes)));
    }

    public static function irregular(CarbonImmutable $date, int $fromHours = 9, int $fromMinutes = 0,
                                            int $toHours = 17, int $toMinutes = 0): IrregularWorkDay
    {
        return new IrregularWorkDay($date,
            new WorkHours(new Time($fromHours, $fromMinutes),
                new Time($toHours, $toMinutes)));
    }
}