<?php declare(strict_types=1);
/**
 * User: volkan
 * Date: 2019-02-23
 */

namespace ServerPlanning;

use ServerPlanning\Exception\MachineSizeException;


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

        $serverCount = 1;
        $machineSize = clone $server;
        foreach ($virtualMachines as $virtualMachine) {
            //check virtual machine size
            if($virtualMachine->getSize() > $server->getSize()
                || $virtualMachine->getRam() > $server->getRam()
                || $virtualMachine->getCpu() > $server->getCpu()
                || $virtualMachine->getHdd() > $server->getHdd()
            ) {
                throw new MachineSizeException("Virtual machine size is to big");
            }
            //if i need server, increase the number of machine
            if ($machineSize->getRam() < $virtualMachine->getRam()
                || $machineSize->getCpu() < $virtualMachine->getCpu()
                || $machineSize->getHdd() < $virtualMachine->getHdd()
            ) {
                $machineSize = clone $server;
                $serverCount++;
            }

            if ($machineSize->getRam() >= $virtualMachine->getRam()
                && $machineSize->getCpu() >= $virtualMachine->getCpu()
                && $machineSize->getHdd() >= $virtualMachine->getHdd()
            ) {
                $machineSize->setRam($machineSize->getRam() - $virtualMachine->getRam());
                $machineSize->setCpu($machineSize->getCpu() - $virtualMachine->getCpu());
                $machineSize->setHdd($machineSize->getHdd() - $virtualMachine->getHdd());
            }
        }

        return $serverCount;
    }
}