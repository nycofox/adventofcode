<?php

namespace App\AdventSolutions\Year2022\Day2;

use App\AdventSolutions\AbstractSolution;

class Solution2022Day2 extends AbstractSolution
{
    const SCORES_PART_ONE = [
        'A X' => 4, // Tie (3 + 1)
        'A Y' => 8, // Win (6 + 2)
        'A Z' => 3, // Lose (0 + 3)
        'B X' => 1, // Lose (0 + 1)
        'B Y' => 5, // Tie (3 + 2)
        'B Z' => 9, // Win (6 + 3)
        'C X' => 7, // Win (6 + 1)
        'C Y' => 2, // Lose (0 + 2)
        'C Z' => 6, // Tie (3 + 3)
    ];

    const SCORES_PART_TWO = [
        'A X' => 3, // Lose (0 + 3)
        'A Y' => 4, // Tie (3 + 1)
        'A Z' => 8, // Win (6 + 2)
        'B X' => 1, // Lose (0 + 1)
        'B Y' => 5, // Tie (3 + 2)
        'B Z' => 9, // Win (6 + 3)
        'C X' => 2, // Lose (0 + 2)
        'C Y' => 6, // Tie (3 + 3)
        'C Z' => 7, // Win (6 + 1)
    ];

    public function solvePart1(array $input): string
    {
        $score = 0;

        foreach ($input as $line) {
            $score += self::SCORES_PART_ONE[$line];
        }

        return "Total score: <info>$score</info>";
    }

    public function solvePart2(array $input): string
    {
        $score = 0;

        foreach ($input as $line) {
            $score += self::SCORES_PART_TWO[$line];
        }

        return "Total score: <info>$score</info>";
    }


}