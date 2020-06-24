<?php declare(strict_types=1);

namespace RobotCleaning;

require __DIR__ . '/vendor/autoload.php';

use RobotCleaning\src\Chargable as Chargable;
use RobotCleaning\src\Hardfloorapartment as Hardfloorapartment;
use RobotCleaning\src\Carpetfloorapartment as Carpetfloorapartment;

/**
 * Robot
 */
class Robot implements Chargable
{
    /**
     * charge
     *
     * @return void
     */
    public function charge(): void
    {
        sleep(30);
    }
    /**
     * checkBatteryAvailability
     * 
     * @param  int $utilizationTime
     * @return int
    */
    public function checkBatteryAvailability($utilizationTime, $decimals = 2): float
    {
        return round((100 - ($utilizationTime / 60) * 100), $decimals);
    }
}

$parameters = getopt('', array("floor:", "area:"));

try {
    if (!in_array($parameters['floor'], array('hard', 'carpet'))) {
        throw new \Exception ('floor should be hard or carpet!');
    }
    if (!is_numeric($parameters['area'])) {
        throw new \Exception('area should be integer!');
    }
    if ($parameters['area'] <= 0) {
        throw new \Exception('area should be greater than 0!');
    }
    if ($parameters['floor'] == 'hard') {
        $objApartment = new Hardfloorapartment(new Robot(), $parameters['floor'], $parameters['area']);
    } else if ($parameters['floor'] == 'carpet') {
        $objApartment = new Carpetfloorapartment(new Robot(), $parameters['floor'], $parameters['area']);
    } 
    $objApartment->clean();
} catch (\Exception $e) {
    echo 'ERROR:: Caught exception: ',  $e->getMessage(), "\n";
}
?>