<?php declare(strict_types=1);
/**
 * User: volkan
 * Date: 2019-02-23
 */

namespace ServerCalculator\Tests;

use PHPUnit\Framework\TestCase;
use ServerCalculator\Exception\MachineSizeException;
use ServerCalculator\ServerCalculator;
use ServerCalculator\ServerType;
use ServerCalculator\VirtualMachine;

/**
 * Class ServerCalculatorTest
 * @package ServerCalculator\Tests
 */
class ServerCalculatorTest extends TestCase
{
    public function testItReturnWhenInputOneServerAndMoreThanOneMachines() : void
    {
        //
        $server = new ServerType();
        $server->setCpu(2);
        $server->setRam(32);
        $server->setHdd(100);

        $virtualMachine = new VirtualMachine();
        $virtualMachine->setCpu(1);
        $virtualMachine->setRam(16);
        $virtualMachine->setHdd(10);

        $virtualMachines[] = $virtualMachine;

        $virtualMachine = new VirtualMachine();
        $virtualMachine->setCpu(1);
        $virtualMachine->setRam(16);
        $virtualMachine->setHdd(10);

        $virtualMachines[] = $virtualMachine;

        $virtualMachine = new VirtualMachine();
        $virtualMachine->setCpu(2);
        $virtualMachine->setRam(32);
        $virtualMachine->setHdd(100);

        $virtualMachines[] = $virtualMachine;

        //
        $virtualMachineCalculator = new ServerCalculator();
        $result = $virtualMachineCalculator->calculate($server, ...$virtualMachines);

        //
        $this->assertSame(2, $result);
    }

    public function testItReturnExceptionWhenVirtualMachineIsToBig(): void
    {
        $this->expectException(MachineSizeException::class);
        //
        $server = new ServerType();
        $server->setCpu(4);
        $server->setRam(32);
        $server->setHdd(100);

        $virtualMachine = new VirtualMachine();
        $virtualMachine->setCpu(8);
        $virtualMachine->setRam(32);
        $virtualMachine->setHdd(100);

        $virtualMachines[] = $virtualMachine;

        //
        $virtualMachineCalculator = new ServerCalculator();
        $virtualMachineCalculator->calculate($server, ...$virtualMachines);
    }

    public function testItReturnExceptionWhenVirtualMachineIsEmpty(): void
    {
        $this->expectException(MachineSizeException::class);

        $server = new ServerType();
        $server->setCpu(4);
        $server->setRam(32);
        $server->setHdd(100);

        //
        $virtualMachines = [];
        $virtualMachineCalculator = new ServerCalculator();
        $virtualMachineCalculator->calculate($server, ...$virtualMachines);
    }
}