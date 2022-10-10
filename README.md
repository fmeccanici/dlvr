# DLVR - PHP Delivery Date Calculator
This package lets you determine the delivery date based on a work schedule, given start date and amount of work days. 

## Installation
```bash
    composer install fmeccanici/dlvr
```
## Examples
### Regular workweek
```injectablephp
<?php

require(__DIR__.'/../vendor/autoload.php');

use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Fmeccanici\Dlvr\Builders\WorkScheduleBuilder;

$workScheduleBuilder = new WorkScheduleBuilder();
$workSchedule = $workScheduleBuilder->addRegularWorkWeek()->build();

$leadTimeInWorkDays = 6;
$now = CarbonImmutable::now()->next(CarbonInterface::MONDAY)->setHour(10)->setMinute(0);
$dueDate = $workSchedule->deliveryDate($now, 6);

// Delivery date next Tuesday
var_dump($dueDate->toDateTimeString());
```

### Irregular workdays
```injectablephp
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
```

### Holidays
```injectablephp
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
$dueDate = $workSchedule->deliveryDate($now, 6);

// Delivery date next Wednesday
var_dump($dueDate->toDateTimeString());
```