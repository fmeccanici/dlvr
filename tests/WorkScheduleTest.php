<?php

use Carbon\CarbonImmutable;
use Fmeccanici\Dlvr\CreateWorkWeek;
use Fmeccanici\Dlvr\DayOfWeek;
use Fmeccanici\Dlvr\Time;
use Fmeccanici\Dlvr\WorkDay;
use Fmeccanici\Dlvr\WorkHours;
use Fmeccanici\Dlvr\WorkSchedule;
use PHPUnit\Framework\TestCase;

class WorkScheduleTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }


    /** @test */
    public function it_should_set_a_regular_work_day()
    {
        // Given
        $companyId = uniqid();
        $dayOfWeek = DayOfWeek::MONDAY;
        $workWeek = CreateWorkWeek::regular()->removeWorkDay($dayOfWeek);
        $workSchedule = new WorkSchedule($workWeek);
        $regularWorkDay = new WorkDay($dayOfWeek, new WorkHours(new Time(9, 0, 0), new Time(17, 0, 0)));

        // When
        $workWeek = $workSchedule->workweek()->setWorkDay($regularWorkDay);

        // Then
        self::assertEquals($regularWorkDay, $workWeek->workDayAt($dayOfWeek));
    }
    
    /** @test */
    public function it_should_calculate_if_date_is_a_work_day()
    {
        $companyId = uniqid();
        $dayOfWeek = DayOfWeek::MONDAY;
        $workWeek = CreateWorkWeek::regular();
        $workSchedule = new WorkSchedule($workWeek);

        // When
        $dateAtMonday = CarbonImmutable::now()->next($dayOfWeek);
        $workDay = $workSchedule->workDay($dateAtMonday->year, $dateAtMonday->month, $dateAtMonday->day);

        // Then
        self::assertEquals($workDay, $workWeek->workDayAt($dayOfWeek));
    }
}