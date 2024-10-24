<?php

namespace App\AdventSolutions\Year2016\Day2;

use App\AdventSolutions\AbstractSolution;

class Solution2016Day2 extends AbstractSolution
{
    public function solvePart1($input): string
    {
        $startposition = [1, 1];

        $code = '';

        // for each input line, move according to each letter

        foreach ($input as $line) {
            $position = $startposition;
            $instructions = str_split($line);
            foreach ($instructions as $instruction) {
                switch ($instruction) {
                    case 'U':
                        $position = $this->moveUp($position);
                        break;
                    case 'D':
                        $position = $this->moveDown($position);
                        break;
                    case 'L':
                        $position = $this->moveLeft($position);
                        break;
                    case 'R':
                        $position = $this->moveRight($position);
                        break;
                }
            }
            $code .= $this->keypad()[$position[1]][$position[0]];
        }
        
        return "The code is: <info>$code</info>";
    }

    public function solvePart2($input): string
    {
        // Implement the logic for solving part 2 here
        
        return "Part 2 not yet implemented!";
    }

    private function keypad(): array
    {
        return [
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9],
        ];
    }

    private function moveUp($position): array
    {
        $position[1] = max(0, $position[1] - 1);
        return $position;
    }

    private function moveDown($position): array
    {
        $position[1] = min(2, $position[1] + 1);
        return $position;
    }

    private function moveLeft($position): array
    {
        $position[0] = max(0, $position[0] - 1);
        return $position;
    }

    private function moveRight($position): array
    {
        $position[0] = min(2, $position[0] + 1);
        return $position;
    }
}