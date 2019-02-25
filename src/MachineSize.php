<?php declare(strict_types=1);
/**
 * User: volkan
 * Date: 2019-02-23
 */

namespace ServerCalculator;

/**
 * Class MachineSize
 * @package ServerCalculator
 */
class MachineSize
{
    protected $cpu;
    protected $ram;
    protected $hdd;

    public function getCpu(): int
    {
        return $this->cpu;
    }

    public function setCpu($cpu)
    {
        $this->cpu = $cpu;
    }

    public function getRam(): int
    {
        return $this->ram;
    }

    public function setRam($ram): void
    {
        $this->ram = $ram;
    }

    public function getHdd(): int
    {
        return $this->hdd;
    }

    public function setHdd($hdd): void
    {
        $this->hdd = $hdd;
    }

    public function getSize(): int
    {
        return $this->getCpu() * $this->getRam() * $this->getHdd();
    }
}