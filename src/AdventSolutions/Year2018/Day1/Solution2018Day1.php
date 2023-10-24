<?php

namespace App\AdventSolutions\Year2018\Day1;

use App\AdventSolutions\AbstractSolution;

class Solution2018Day1 extends AbstractSolution
{
    public function solvePart1($input): string
    {
        $answer = array_sum($input);
        
        return "Resulting frequency: <info>$answer</info>";
    }

    public function solvePart2($input): string
    {
        $sum = 0;
        $frequencies = [];
        $frequencies[0] = true;

        while (true) {
            foreach ($input as $frequency) {
                $sum += $frequency;

                if (isset($frequencies[$sum])) {
                    return "First frequency reached twice: <info>$sum</info>";
                }

                $frequencies[$sum] = true;
            }
        }
    }
}