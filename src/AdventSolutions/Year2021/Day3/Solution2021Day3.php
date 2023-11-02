<?php

namespace App\AdventSolutions\Year2021\Day3;

use App\AdventSolutions\AbstractSolution;

class Solution2021Day3 extends AbstractSolution
{

    public function solvePart1($input): string
    {
        $positionCounts = array_fill(0, strlen($input[0]), 0);

        foreach ($input as $binaryString) {
            $binaryArray = str_split($binaryString);

            foreach ($binaryArray as $position => $value) {
                if ($value === '1') {
                    $positionCounts[$position]++;
                }
            }
        }

        $gamma = '';
        $epsilon = '';

        foreach ($positionCounts as $count) {
            if ($count > count($input) / 2) {
                $gamma .= '1';
                $epsilon .= '0';
            } else {
                $gamma .= '0';
                $epsilon .= '1';
            }
        }

        $power = bindec($gamma) * bindec($epsilon);

        return "Power consumption is: <info>$power</info>";
    }

    public function solvePart2($input): string
    {
        // Solve advent of code 2021 day 3 part 2


        return "Part 2 not yet implemented!";
    }


}