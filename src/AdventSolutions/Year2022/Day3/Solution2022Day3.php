<?php

namespace App\AdventSolutions\Year2022\Day3;

use App\AdventSolutions\AbstractSolution;

class Solution2022Day3 extends AbstractSolution
{

    public function solvePart1(array $input): string
    {
        $sum_1 = 0;

        foreach ($input as $rucksack) {
            $letters_1 = str_split(substr($rucksack, 0, strlen($rucksack) / 2));
            $letters_2 = str_split(substr($rucksack, strlen($rucksack) / 2));

            $common = implode(array_unique(array_intersect($letters_1, $letters_2)));

            $sum_1 += $this->lettervalue($common);
        }

        return "Sum of priorities: <info>$sum_1</info>";

    }

    public function solvePart2(array $input): string
    {
        $sum_2 = 0;

        foreach (array_chunk($input, 3) as $group) {
            $common = implode(array_unique(array_intersect(str_split($group[0]), str_split($group[1]), str_split($group[2]))));

            $sum_2 += $this->lettervalue($common);
        }

        return "Sum of priorities: <info>$sum_2</info>";
    }

    private function lettervalue($letter)
    {
        if (ctype_lower($letter)) {
            return ord($letter) - 96;
        }

        return ord($letter) - 38;
    }

}