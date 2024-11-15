<?php

namespace App\AdventSolutions\Year2020\Day3;

use App\AdventSolutions\AbstractSolution;

class Solution2020Day3 extends AbstractSolution
{
    public function solvePart1($input): string
    {
        $width = strlen($input[0]);
        $height = count($input);
        $x = 0;
        $y = 0;
        $trees = 0;
        while ($y < $height) {
            if ($input[$y][$x] === "#") {
                $trees++;
            }
            $x = ($x + 3) % $width;
            $y++;
        }
        return "You would encounter <info>$trees</info> trees on the way down.";
    }

    public function solvePart2($input): string
    {
        $width = strlen($input[0]);
        $height = count($input);
        $slopes = [
            [1, 1],
            [3, 1],
            [5, 1],
            [7, 1],
            [1, 2],
        ];
        $result = 1;
        foreach ($slopes as $slope) {
            $x = 0;
            $y = 0;
            $trees = 0;
            while ($y < $height) {
                if ($input[$y][$x] === "#") {
                    $trees++;
                }
                $x = ($x + $slope[0]) % $width;
                $y += $slope[1];
            }
            $result *= $trees;
        }
        return "The product of the number of trees encountered on each slope is <info>$result</info>.";
    }
}