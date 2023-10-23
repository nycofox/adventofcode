<?php

namespace App\AdventSolutions\Year2022\Day1;

use App\AdventSolutions\AbstractSolution;

class Solution2022Day1 extends AbstractSolution
{
    public function solvePart1(array $input): string
    {
        // Implement the logic for solving part 1 of the puzzle here
        $elves = $this->elves($input);

        return "The elf with the most calories has a total of <info>" . max($elves) . "</info> calories";
    }

    public function solvePart2(array $input): string
    {
        // Implement the logic for solving part 2 of the puzzle here
        $elves = $this->elves($input);
        $sorted = array_slice($elves, -3, 3);

        return "The three elves with the most calories have a total of <info>" . array_sum($sorted) . "</info> calories";
    }

    private function elves(array $input): array
    {
        $elves = [];
        $rowdata = [];

        foreach ($input as $row) {
            if (empty($row)) {
                $elves[] = array_sum($rowdata);
                $rowdata = [];
            }

            $rowdata[] = (int)$row;
        }

        natsort($elves);

        return $elves;
    }
}