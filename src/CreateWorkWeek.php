<?php

namespace Fmeccanici\Dlvr;

class CreateWorkWeek
{
    public static function regular(): WorkWeek
    {
        $from = new Time(9, 0);
        $to = new Time(17, 0);
        $monday = new RegularWorkDay(DayOfWeek::MONDAY, new WorkHours($from, $to));
        $tuesday = new RegularWorkDay(DayOfWeek::MONDAY, new WorkHours($from, $to));
        $wednesday = new RegularWorkDay(DayOfWeek::MONDAY, new WorkHours($from, $to));
        $thursday = new RegularWorkDay(DayOfWeek::MONDAY, new WorkHours($from, $to));
        $friday = new RegularWorkDay(DayOfWeek::MONDAY, new WorkHours($from, $to));
        $saturday = null;
        $sunday = null;

        return new WorkWeek($monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday);
    }

}