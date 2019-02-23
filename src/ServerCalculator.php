<?php declare(strict_types=1);
/**
 * User: volkan
 * Date: 2019-02-23
 */

namespace ServerCalculator;

use ServerCalculator\Exception\MachineSizeException;

/**
 * Class ServerCalculator
 * @package ServerCalculator
 */
class ServerCalculator
{
    /**
     * @param ServerType $server
     * @param VirtualMachine ...$virtualMachines
     * @return int
     * @throws MachineSizeException
     */
    public function calculate(ServerType $server, VirtualMachine ...$virtualMachines) : int
    {
        if (count($virtualMachines) <= 0) {
            throw new MachineSizeException("Must be at least one virtual machine");
        }

        $serverCount = 0;
        $serverSwapSize = $server->getSize();
        foreach ($virtualMachines as $machine) {
            if($machine->getSize() > $server->getSize()) {
                throw new MachineSizeException("Virtual machine size is to big");
            }

            if ($serverSwapSize >= $machine->getSize()) {
                $serverCount++;
                $serverSwapSize -= $machine->getSize();
            } else {
                $serverSwapSize = $server->getSize();
            }
        }

        return $serverCount;
    }
}