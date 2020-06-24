<?php declare(strict_types=1);

namespace RobotCleaning\src;

use RobotCleaning\Robot as Robot;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Class Apartment
 */
class Apartment
{
    /**
     * log
     *
     * @var mixed
     */
    protected $log;  
    /**
     * Robot
     * 
     * @var Robot
     */
    protected $robot;
    /**
     * floor
     *
     * @var string
     */
    protected $floor;    
    /**
     * area
     *
     * @var int
     */
    protected $area;    
    /**
     * __construct
     *
     * @param  object $robot
     * @param  string $floor
     * @param  int $area
     * @return void
     */
    public function __construct(Robot $robot, $floor, $area)
    {
        $this->floor = $floor;
        $this->area = $area;
        $this->robot = $robot;
        // create a log channel
        $this->log = new Logger('name');
        $this->log->pushHandler(new StreamHandler('logs/log-'.date('d-m-y-h-i-s').'.log', Logger::DEBUG));
        $this->log->addInfo('Robot started and battery indicates charging 100%');
    }
    /**
     * processClean
     *
     * @param  int $cleanTileTime
     * @return void
     */
    public function processClean($cleanTileTime): void
    {
        for ($i=$battery=1; $i<=$this->area; $i++,$battery++) {
            $batteryPercentage = $this->robot->checkBatteryAvailability(($battery * $cleanTileTime));
            $this->log->addInfo('Robot is cleaning "'.$i.'" tile on floor "'.$this->floor.'" and battery indicates charging '.$batteryPercentage.'%');
            sleep($cleanTileTime);
            if ($i % (60 / $cleanTileTime) == 0) {
                $battery = 0;
                $this->log->addWarning('Robot battery exhausted and it indicates charging 0%');
                $this->log->addInfo('Robot charging started and it tooks 30 seconds!!');
                $this->robot->charge();
                $this->log->addInfo('Robot fully charged!!');
            }
        }
    }
}