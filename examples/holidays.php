<?php

require(__DIR__.'/../vendor/autoload.php');

use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Fmeccanici\Dlvr\Builders\WorkScheduleBuilder;

$workScheduleBuilder = new WorkScheduleBuilder();
$workSchedule = $workScheduleBuilder->addRegularWorkWeek()->build();
$workSchedule->addHoliday(CarbonImmutable::now()->nextWeekday());

$leadTimeInWorkDays = 6;
$now = CarbonImmutable::now()->next(CarbonInterface::MONDAY)->setHour(10)->setMinute(0);
$dueDate = $workSchedule->deliveryDate($now, $leadTimeInWorkDays);

// Delivery date next Wednesday
var_dump($dueDate->toDateTimeString());