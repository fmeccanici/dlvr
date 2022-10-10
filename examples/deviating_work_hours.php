<?php

require(__DIR__.'/../vendor/autoload.php');

use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Fmeccanici\Dlvr\Builders\WorkScheduleBuilder;

$workScheduleBuilder = new WorkScheduleBuilder();
$workSchedule = $workScheduleBuilder
    ->addRegularWorkWeek()
    ->addDeviatingWorkHours(CarbonImmutable::now()->next(CarbonImmutable::MONDAY), 9, 0, 12, 0)
    ->build();

$leadTimeInWorkDays = 6;
$now = CarbonImmutable::now()->next(CarbonInterface::MONDAY)->setHour(10)->setMinute(0);
$dueDate = $workSchedule->deliveryDate($now, 6);

// Delivery date next Tuesday
var_dump($dueDate->toDateTimeString());
