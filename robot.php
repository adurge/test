<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Interface cleanable
 */
interface cleanable
{    
    /**
     * clean
     *
     * @return void
     */
    public function clean() : void;
}

/**
 * Interface chargable
 */
interface chargable
{    
    /**
     * charge
     *
     * @return void
     */
    public function charge() : void;
}

/**
 * Interface Machine
 */
interface Machine extends cleanable,chargable
{
}

/**
 * Robot
 */
class Robot implements Machine
{    
    /**
     * log
     *
     * @var mixed
     */
    public $log;    
    /**
     * floor
     *
     * @var mixed
     */
    public $floor;    
    /**
     * area
     *
     * @var mixed
     */
    public $area;    
    /**
     * __construct
     *
     * @param  mixed $floor
     * @param  mixed $area
     * @return void
     */
    public function __construct($floor, $area)
    {
        $this->floor = $floor;
        $this->area = $area;
        // create a log channel
        $this->log = new Logger('name');
        $this->log->pushHandler(new StreamHandler('logs/log-'.date('d-m-y-h-i-s').'.log', Logger::DEBUG));
        $this->log->addInfo('Robot started and battery indicates charging 100%');
    }
    
    /**
     * clean
     *
     * @return void
     */
    public function clean(): void
    {
        $this->log->addInfo('floor '.$this->floor.' has '.$this->area.' tiles and each one have size of 1m X 1m');
        for ($i=1; $i<=$this->area; $i++) {
            $this->log->addInfo('Cleaning tile '.$i.' on floor '.$this->floor);
            if ($this->floor == 'hard') {
                $cleanTileTime = 1;
            } else if ($this->floor == 'carpet') {
                $cleanTileTime = 2;
            }
            sleep($cleanTileTime);
            if ($i % (60 / $cleanTileTime) == 0) {
                $this->log->addWarning('Robot battery exhausted and it indicates charging 0%');
                $this->charge();
            }
        }
    }
    
    /**
     * charge
     *
     * @return void
     */
    public function charge(): void
    {
        $this->log->addInfo('Robot charging started and it tooks 30 seconds!!');
        sleep(30);
        $this->log->addInfo('Robot fully charged!!');
    }
}

$parameters = getopt('', array("floor:", "area:"));

try {
    if (!in_array($parameters['floor'], array('hard', 'carpet'))) {
        throw new Exception('floor should be hard or carpet!');
    }
    if (!is_numeric($parameters['area'])) {
        throw new Exception('area should be integer!');
    }
    if ($parameters['area'] <= 0) {
        throw new Exception('area should be greater than 0!');
    }
    $objRobot = new Robot($parameters['floor'], $parameters['area']);
    $objRobot->clean();    
} catch (Exception $e) {
    echo 'ERROR:: Caught exception: ',  $e->getMessage(), "\n";
}
?>