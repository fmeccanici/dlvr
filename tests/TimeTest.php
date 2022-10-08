<?php

use Fmeccanici\Dlvr\WorkDays\Time;
use PHPUnit\Framework\TestCase;

class TimeTest extends TestCase
{
    /** @test */
    public function it_should_be_after_specified_time()
    {
        // Given
        $time = new Time(9, 0);
        $otherTime = new Time(8, 0);

        // When
        $isAfter = $time->isAfter($otherTime);

        // Then
        self::assertTrue($isAfter);
    }

    /** @test */
    public function it_should_be_before_specified_time()
    {
        // Given
        $time = new Time(8, 0);
        $otherTime = new Time(9, 0);

        // When
        $isAfter = $time->isBefore($otherTime);

        // Then
        self::assertTrue($isAfter);
    }
}