<?php

namespace Fmeccanici\Dlvr;

use Carbon\CarbonImmutable;

interface WorkScheduleBuilderInterface
{
    public function addRegularWorkDay(int $dayOfWeek, int $startHour, int $startMinute, int $endHour, int $endMinute): WorkScheduleBuilder;
    public function addHoliday(CarbonImmutable $date): WorkScheduleBuilder;
    public function addDeviatingWorkHours(CarbonImmutable $date, int $startHour, int $startMinute, int $endHour, int $endMinute): WorkScheduleBuilder;
    public function build(): WorkSchedule;
}