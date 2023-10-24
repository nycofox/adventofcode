<?php

namespace App\AdventSolutions\Year2019\Day1;

use App\AdventSolutions\AbstractSolution;

class Solution2019Day1 extends AbstractSolution
{
    public function solvePart1($input): string
    {
        $totalFuel = 0;

        foreach ($input as $mass) {
            $fuel = floor($mass / 3) - 2;
            $totalFuel += $fuel;
        }
        
        return "Total fuel required: <info>$totalFuel</info>";
    }

    public function solvePart2($input): string
    {
        $totalFuel = 0;

        foreach ($input as $mass) {
            $fuel = $this->calculateFuel($mass);
            $totalFuel += $fuel;
        }

        return "Total fuel required: <info>$totalFuel</info>";
    }

    private function calculateFuel($mass)
    {
        $fuel = floor($mass / 3) - 2;

        if ($fuel <= 0) {
            return 0;
        }

        return $fuel + $this->calculateFuel($fuel);
    }
}