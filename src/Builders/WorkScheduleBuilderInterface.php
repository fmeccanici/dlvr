<?php

namespace Fmeccanici\Dlvr\Builders;

use Carbon\CarbonImmutable;
use Fmeccanici\Dlvr\WorkSchedule;

interface WorkScheduleBuilderInterface
{
    public function addRegularWorkDay(int $dayOfWeek, int $startHour, int $startMinute, int $endHour, int $endMinute): WorkScheduleBuilder;
    public function addHoliday(CarbonImmutable $date): WorkScheduleBuilder;
    public function addDeviatingWorkHours(CarbonImmutable $date, int $startHour, int $startMinute, int $endHour, int $endMinute): WorkScheduleBuilder;
    public function addRegularWorkWeek(): WorkScheduleBuilder;
    public function build(): WorkSchedule;
}