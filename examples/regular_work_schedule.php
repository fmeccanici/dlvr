<?php

use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Fmeccanici\Dlvr\Builders\WorkScheduleBuilder;
use Fmeccanici\Dlvr\SupplyChain;

$workSchedule = SupplyChain::createRegularWorkSchedule(new WorkScheduleBuilder());
$leadTimeInWorkDays = 6;
$dueDate = $workSchedule->dueDate(CarbonImmutable::now()->next(CarbonInterface::MONDAY), 6);
