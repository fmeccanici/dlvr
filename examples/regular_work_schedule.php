<?php

require(__DIR__.'/../vendor/autoload.php');

use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Fmeccanici\Dlvr\Builders\WorkScheduleBuilder;

$workScheduleBuilder = new WorkScheduleBuilder();
$workSchedule = $workScheduleBuilder->addRegularWorkWeek()->build();

$leadTimeInWorkDays = 6;
$now = CarbonImmutable::now()->next(CarbonInterface::MONDAY)->setHour(10)->setMinute(0);
$dueDate = $workSchedule->dueDate($now, 6);

// Due date nest Tuesday
var_dump($dueDate->toDateTimeString());