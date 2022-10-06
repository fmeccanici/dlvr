<?php

namespace Fmeccanici\Dlvr;

class CreateWorkDay
{
    public static function monday(int $fromHours = 9, int $fromMinutes = 0,
                                  int $toHours = 17, int $toMinutes = 0): WorkDay
    {
        return new WorkDay(DayOfWeek::MONDAY,
            new WorkHours(new Time($fromHours, $fromMinutes),
            new Time($toHours, $toMinutes)));
    }

    public static function tuesday(int $fromHours = 9, int $fromMinutes = 0,
                                  int $toHours = 17, int $toMinutes = 0): WorkDay
    {
        return new WorkDay(DayOfWeek::TUESDAY,
            new WorkHours(new Time($fromHours, $fromMinutes),
                new Time($toHours, $toMinutes)));
    }

    public static function wednesday(int $fromHours = 9, int $fromMinutes = 0,
                                  int $toHours = 17, int $toMinutes = 0): WorkDay
    {
        return new WorkDay(DayOfWeek::WEDNESDAY,
            new WorkHours(new Time($fromHours, $fromMinutes),
                new Time($toHours, $toMinutes)));
    }

    public static function thursday(int $fromHours = 9, int $fromMinutes = 0,
                                    int $toHours = 17, int $toMinutes = 0): WorkDay
    {
        return new WorkDay(DayOfWeek::THURSDAY,
            new WorkHours(new Time($fromHours, $fromMinutes),
                new Time($toHours, $toMinutes)));
    }

    public static function friday(int $fromHours = 9, int $fromMinutes = 0,
                                    int $toHours = 17, int $toMinutes = 0): WorkDay
    {
        return new WorkDay(DayOfWeek::FRIDAY,
            new WorkHours(new Time($fromHours, $fromMinutes),
                new Time($toHours, $toMinutes)));
    }

    public static function saturday(int $fromHours = 9, int $fromMinutes = 0,
                                    int $toHours = 17, int $toMinutes = 0): WorkDay
    {
        return new WorkDay(DayOfWeek::SATURDAY,
            new WorkHours(new Time($fromHours, $fromMinutes),
                new Time($toHours, $toMinutes)));
    }

    public static function sunday(int $fromHours = 9, int $fromMinutes = 0,
                                    int $toHours = 17, int $toMinutes = 0): WorkDay
    {
        return new WorkDay(DayOfWeek::SUNDAY,
            new WorkHours(new Time($fromHours, $fromMinutes),
                new Time($toHours, $toMinutes)));
    }
}