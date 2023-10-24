<?php

namespace App\AdventSolutions\Year2021\Day1;

use App\AdventSolutions\AbstractSolution;

class Solution2021Day1 extends AbstractSolution
{
    public function solvePart1($input): string
    {
        $increases = 0;

        for ($i = 0; $i < count($input); $i++) {
            if ($i > 0 && $input[$i] > $input[$i - 1]) {
                $increases++;
            }
        }

        return "<info>$increases</info> measurements are bigger than the previous number in the list.";
    }

    public function solvePart2($input): string
    {
        $increases = 0;
        $sumPrevious = 0;

        for ($i = 0; $i < (count($input) - 2); $i++) {
            $sum = $input[$i] + $input[$i + 1] + $input[$i + 2];

            if ($sumPrevious > 0 && $sum > $sumPrevious) {
                $increases++;
            }

            $sumPrevious = $sum;
        }

        return "<info>$increases</info> measurements are bigger than the sum of the previous 3 numbers in the list.";
    }
}