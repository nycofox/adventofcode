<?php

namespace App\AdventSolutions\Year2022\Day4;

use App\AdventSolutions\AbstractSolution;

class Solution2022Day4 extends AbstractSolution
{
    public function solvePart1($input): string
    {
        $fully_overlaps = 0;

        foreach ($input as $pair) {
            $elves = explode(',', $pair);

            $elf1 = explode('-', $elves[0]);
            $elf2 = explode('-', $elves[1]);

            if (
                ($elf1[0] >= $elf2[0] && $elf1[1] <= $elf2[1]) ||
                ($elf2[0] >= $elf1[0] && $elf2[1] <= $elf1[1])
            ) {
                $fully_overlaps++;
            }
        }

        
        return "Part 1: Fully overlaps: <info>$fully_overlaps</info>";
    }

    public function solvePart2($input): string
    {
        $partial_overlaps = 0;

        foreach ($input as $pair) {
            $elves = explode(',', $pair);

            $elf1 = explode('-', $elves[0]);
            $elf2 = explode('-', $elves[1]);

            if (!($elf1[1] < $elf2[0]) && !($elf2[1] < $elf1[0])) {
                $partial_overlaps++;
            }
        }
        
        return "Part 2: Partial overlaps: <info>$partial_overlaps</info>";
    }
}