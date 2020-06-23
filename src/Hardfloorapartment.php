<?php declare(strict_types=1);

namespace test;

/**
 * Class Hardfloorapartment
 */
class Hardfloorapartment extends Apartment implements Cleanable
{
    /**
     * clean
     * 
     * @return void
     */
    public function clean() : void
    {
        $this->log->addInfo('floor '.$this->floor.' has '.$this->area.' tiles and each one have size of 1m X 1m');
        $this->processClean($cleanTileTime = 1);
    }
}