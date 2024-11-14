<?php

namespace App\AdventSolutions\Year2020\Day1;

use App\AdventSolutions\AbstractSolution;

class Solution2020Day1 extends AbstractSolution
{
    public function solvePart1($input): string
    {
        foreach ($input as $value) {
            foreach ($input as $value2) {
                if ($value + $value2 === 2020) {
                    return $value * $value2;
                }
            }
        }

        return "No solution found!";
    }

    public function solvePart2($input): string
    {
        foreach ($input as $value) {
            foreach ($input as $value2) {
                foreach ($input as $value3) {
                    if ($value + $value2 + $value3 === 2020) {
                        return $value * $value2 * $value3;
                    }
                }
            }
        }

        return "No solution found!";
    }
}