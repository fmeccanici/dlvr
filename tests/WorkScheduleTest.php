<?php

use Carbon\CarbonImmutable;
use Fmeccanici\Dlvr\CreateWorkDay;
use Fmeccanici\Dlvr\CreateWorkSchedule;
use Fmeccanici\Dlvr\CreateWorkWeek;
use Fmeccanici\Dlvr\DayOfWeek;
use Fmeccanici\Dlvr\RegularWorkDay;
use Fmeccanici\Dlvr\SupplyChain;
use Fmeccanici\Dlvr\Time;
use Fmeccanici\Dlvr\WorkDay;
use Fmeccanici\Dlvr\WorkHours;
use Fmeccanici\Dlvr\WorkSchedule;
use Fmeccanici\Dlvr\WorkScheduleBuilder;
use PHPUnit\Framework\TestCase;

class WorkScheduleTest extends TestCase
{
    protected WorkScheduleBuilder $workScheduleBuilder;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->workScheduleBuilder = new WorkScheduleBuilder();
    }


    /** @test */
    public function it_should_set_a_regular_work_day()
    {
        // Given
        $companyId = uniqid();
        $dayOfWeek = DayOfWeek::MONDAY;
        $workWeek = CreateWorkWeek::regular()->removeWorkDay($dayOfWeek);
        $workSchedule = new WorkSchedule($workWeek);
        $regularWorkDay = new RegularWorkDay($dayOfWeek, new WorkHours(new Time(9, 0, 0), new Time(17, 0, 0)));

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

    /** @test */
    public function it_should_be_due_one_day_after_start()
    {
        // Given
        $dayOfWeek = DayOfWeek::MONDAY;
        $workSchedule = SupplyChain::createRegularWorkSchedule($this->workScheduleBuilder);
        $startDate = CarbonImmutable::now()->next($dayOfWeek)->setHour(10)->setMinute(0);

        // When
        $dueDate = $workSchedule->dueDate($startDate, 1);

        // Then
        self::assertEquals($startDate->addDay()->startOfDay(), $dueDate->startOfDay());
        self::assertEquals(9, $dueDate->hour);
        self::assertEquals(0, $dueDate->minute);
    }
    
    /** @test */
    public function it_should_calculate_due_date_for_regular_work_week()
    {
        // Given
        $dayOfWeek = DayOfWeek::MONDAY;
        $workSchedule = SupplyChain::createRegularWorkSchedule($this->workScheduleBuilder);
        $startDate = CarbonImmutable::now()->next($dayOfWeek)->setHour(16)->setMinute(0);

        // When
        $dueDate = $workSchedule->dueDate($startDate, 2);

        // Then
        self::assertEquals($startDate->addDays(2)->startOfDay(), $dueDate->startOfDay());
        self::assertEquals(9, $dueDate->hour);
        self::assertEquals(0, $dueDate->minute);
    }
    
    /** @test */
    public function it_should_start_next_day_if_after_work_hours()
    {
        // Given
        $dayOfWeek = DayOfWeek::MONDAY;
        $workSchedule = SupplyChain::createRegularWorkSchedule($this->workScheduleBuilder);
        $startDate = CarbonImmutable::now()->next($dayOfWeek)->setHour(17)->setMinute(1);

        // When
        $dueDate = $workSchedule->dueDate($startDate, 2);

        // Then
        self::assertEquals($startDate->addDays(3)->startOfDay(), $dueDate->startOfDay());
        self::assertEquals(9, $dueDate->hour);
        self::assertEquals(0, $dueDate->minute);
    }
    
    /** @test */
    public function it_should_start_same_day_if_before_work_hours()
    {
        // Given
        $dayOfWeek = DayOfWeek::MONDAY;
        $workSchedule = SupplyChain::createRegularWorkSchedule($this->workScheduleBuilder);
        $startDate = CarbonImmutable::now()->next($dayOfWeek)->setHour(8)->setMinute(0);

        // When
        $dueDate = $workSchedule->dueDate($startDate, 2);

        // Then
        self::assertEquals($startDate->addDays(2)->startOfDay(), $dueDate->startOfDay());
        self::assertEquals(9, $dueDate->hour);
        self::assertEquals(0, $dueDate->minute);
    }
    
    /** @test */
    public function it_should_take_into_account_irregular_work_day()
    {
        // Given
        $startDate = CarbonImmutable::now()->next(CarbonImmutable::MONDAY)->setHour(12);

        $irregularWorkDay = CreateWorkDay::irregular($startDate, 9, 0, 11, 0);
        $workSchedule = SupplyChain::createRegularWorkSchedule($this->workScheduleBuilder);
        $workSchedule->addIrregularWorkDay($irregularWorkDay->workHours(), $irregularWorkDay->date());

        // When
        $dueDate = $workSchedule->dueDate($startDate, 2);

        // Then
        self::assertEquals($startDate->addDays(3)->startOfDay(), $dueDate->startOfDay());
        self::assertEquals(9, $dueDate->hour);
        self::assertEquals(0, $dueDate->minute);
    }
    
    /** @test */
    public function it_should_take_into_account_holidays()
    {
        // Given
        $startDate = CarbonImmutable::now()->next(CarbonImmutable::MONDAY)->setHour(9)->setMinute(0);

        $workSchedule = SupplyChain::createRegularWorkSchedule($this->workScheduleBuilder);
        $workSchedule->addHoliday(CarbonImmutable::now()->next(CarbonImmutable::MONDAY));

        // When
        $dueDate = $workSchedule->dueDate($startDate, 2);

        // Then
        self::assertEquals($startDate->addDays(3)->startOfDay(), $dueDate->startOfDay());
        self::assertEquals(9, $dueDate->hour);
        self::assertEquals(0, $dueDate->minute);
    }

    /** @test */
    public function it_should_take_into_account_irregular_work_days_and_holidays()
    {
        // Given
        $startDate = CarbonImmutable::now()->next(CarbonImmutable::MONDAY)->setHour(16);

        $workSchedule = SupplyChain::createRegularWorkSchedule($this->workScheduleBuilder);
        $irregularWorkDay = CreateWorkDay::irregular(CarbonImmutable::now()->next(CarbonImmutable::MONDAY), 9, 0, 15, 0);
        $workSchedule->addIrregularWorkDay($irregularWorkDay->workHours(), $irregularWorkDay->date());
        $workSchedule->addHoliday(CarbonImmutable::now()->next(CarbonImmutable::TUESDAY));

        // When
        $dueDate = $workSchedule->dueDate($startDate, 2);

        // Then
        self::assertEquals($startDate->addDays(4)->startOfDay(), $dueDate->startOfDay());
        self::assertEquals(9, $dueDate->hour);
        self::assertEquals(0, $dueDate->minute);
    }
}