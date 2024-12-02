<?php

namespace App\AdventSolutions\Year2024\Day1;

use App\AdventSolutions\AbstractSolution;

class Solution2024Day1 extends AbstractSolution
{
    public function solvePart1($input, $debug = false): string
    {
        $totalDistance = 0;

        $lists = $this->sortInput($input);

        for ($i = 0; $i < count($lists[0]); $i++) {
            $totalDistance += abs($lists[0][$i] - $lists[1][$i]);
        }
        
        return "The total distance between the two columns is: <info>$totalDistance</info>";
    }

    public function solvePart2($input, $debug = false): string
    {
        // Implement the logic for solving part 2 here
        
        return "Part 2 not yet implemented!";
    }

    private function sortInput($input): array
    {
        $column1 = [];
        $column2 = [];

        foreach ($input as $line) {
            $numbers = preg_split('/\s+/', trim($line));
            $column1[] = (int) $numbers[0]; // Convert to integers
            $column2[] = (int) $numbers[1];
        }

        sort($column1);
        sort($column2);

        return [$column1, $column2];
    }
}