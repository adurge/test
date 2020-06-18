<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * RobotTest
 */
class RobotTest extends TestCase
{    
    /**
     * robot
     *
     * @var mixed
     */
    protected $robot;
    
    /**
     * cleanTest
     * 
     * @test
     * @covers ../robot/clean::void
     *
     * @return void
     */
    public function cleanTest()
    {
        $robot = $this->getMockBuilder(Robot::class)
                      ->setMethods(['clean'])
                      ->getMock();
        $robot->expects($this->once())
                ->method('clean')
                ->will($this->returnValue(null));
        $this->assertEquals(null, $robot->clean());
    }
    /**
     * chargeTest
     * 
     * @test
     * @covers ../robot/charge::void
     * 
     * @return void
     */
    public function chargeTest()
    {
        $robot = $this->getMockBuilder(Robot::class)
                      ->setMethods(['charge'])
                      ->getMock();
        $robot->expects($this->once())
                ->method('charge')
                ->will($this->returnValue(null));
        $this->assertEquals(null, $robot->charge());
    }
}