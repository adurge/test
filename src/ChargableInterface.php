<?php declare(strict_types=1);

namespace RobotCleaning\src;

/**
 * Interface chargable
 */
interface Chargable
{
    /**
     * charge
     *
     * @return void
     */
    public function charge() : void;
    /**
     * checkBatteryAvailability
     *
     * @param int $utilizationTime
     * @param int $decimals
     * @return void
     */
    public function checkBatteryAvailability($utilizationTime, $decimals) : float;
}