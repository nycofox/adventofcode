<?php

namespace App\AdventSolutions\Year2022\Day1;

use App\AdventSolutions\AbstractSolution;

class Solution2022Day1 extends AbstractSolution
{
    public function solvePart1(array $input): string
    {
        // Implement the logic for solving part 1 of the puzzle here
        $max_calories = max($this->elves($input));

        return "The elf with the most calories has a total of <info>$max_calories</info> calories";
    }

    public function solvePart2(array $input): string
    {
        $elves = $this->elves($input);
        $sorted = array_slice($elves, -3, 3);
        $sum = array_sum($sorted);

        return "The three elves with the most calories have a total of <info>$sum</info> calories";
    }

    private function elves(array $input): array
    {
        $elves = [];
        $row_data = [];

        foreach ($input as $row) {
            if (empty($row)) {
                $elves[] = array_sum($row_data);
                $row_data = [];
            }

            $row_data[] = (int)$row;
        }

        natsort($elves);

        return $elves;
    }
}