<?php

namespace Fmeccanici\Dlvr;

class CreateWorkDay
{
    public static function monday(int $fromHours, int $fromMinutes, int $fromSeconds,
                                  int $toHours, int $toMinutes, int $toSeconds): WorkDay
    {
        return new WorkDay(DayOfWeek::MONDAY,
            new WorkingHours(new Time($fromHours, $fromMinutes, $fromSeconds),
            new Time($toHours, $toMinutes, $toSeconds)));
    }

    public static function tuesday(int $fromHours, int $fromMinutes, int $fromSeconds,
                                  int $toHours, int $toMinutes, int $toSeconds): WorkDay
    {
        return new WorkDay(DayOfWeek::TUESDAY,
            new WorkingHours(new Time($fromHours, $fromMinutes, $fromSeconds),
                new Time($toHours, $toMinutes, $toSeconds)));
    }

    public static function wednesday(int $fromHours, int $fromMinutes, int $fromSeconds,
                                   int $toHours, int $toMinutes, int $toSeconds): WorkDay
    {
        return new WorkDay(DayOfWeek::WEDNESDAY,
            new WorkingHours(new Time($fromHours, $fromMinutes, $fromSeconds),
                new Time($toHours, $toMinutes, $toSeconds)));
    }

    public static function thursday(int $fromHours, int $fromMinutes, int $fromSeconds,
                                   int $toHours, int $toMinutes, int $toSeconds): WorkDay
    {
        return new WorkDay(DayOfWeek::THURSDAY,
            new WorkingHours(new Time($fromHours, $fromMinutes, $fromSeconds),
                new Time($toHours, $toMinutes, $toSeconds)));
    }

    public static function friday(int $fromHours, int $fromMinutes, int $fromSeconds,
                                   int $toHours, int $toMinutes, int $toSeconds): WorkDay
    {
        return new WorkDay(DayOfWeek::FRIDAY,
            new WorkingHours(new Time($fromHours, $fromMinutes, $fromSeconds),
                new Time($toHours, $toMinutes, $toSeconds)));
    }

    public static function saturday(int $fromHours, int $fromMinutes, int $fromSeconds,
                                   int $toHours, int $toMinutes, int $toSeconds): WorkDay
    {
        return new WorkDay(DayOfWeek::SATURDAY,
            new WorkingHours(new Time($fromHours, $fromMinutes, $fromSeconds),
                new Time($toHours, $toMinutes, $toSeconds)));
    }

    public static function sunday(int $fromHours, int $fromMinutes, int $fromSeconds,
                                   int $toHours, int $toMinutes, int $toSeconds): WorkDay
    {
        return new WorkDay(DayOfWeek::SUNDAY,
            new WorkingHours(new Time($fromHours, $fromMinutes, $fromSeconds),
                new Time($toHours, $toMinutes, $toSeconds)));
    }
}