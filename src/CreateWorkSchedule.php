<?php

namespace Fmeccanici\Dlvr;

class CreateWorkSchedule
{
    public static function regular(): WorkSchedule
    {
        $workWeek = CreateWorkWeek::regular();

        return new WorkSchedule($workWeek);
    }

}