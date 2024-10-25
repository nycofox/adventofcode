<?php

namespace App\AdventSolutions\Year2016\Day2;

use App\AdventSolutions\AbstractSolution;

class Solution2016Day2 extends AbstractSolution
{
    public function solvePart1($input): string
    {
        $code = '';
        $position = [1, 1]; // Start at '5' on a 3x3 grid

        foreach ($input as $line) {
            $instructions = str_split($line);
            foreach ($instructions as $instruction) {
                $position = $this->move($position, $instruction, $this->keypad());
            }
            $code .= $this->keypad()[$position[1]][$position[0]];
        }

        return "The code for Part 1 is: <info>$code</info>";
    }

    public function solvePart2($input): string
    {
        $code = '';
        $position = [0, 2]; // Start at '5' on the Part 2 keypad layout

        foreach ($input as $line) {
            $instructions = str_split($line);
            foreach ($instructions as $instruction) {
                $position = $this->move($position, $instruction, $this->keypad2());
            }
            $code .= $this->keypad2()[$position[1]][$position[0]];
        }

        return "The code for Part 2 is: <info>$code</info>";
    }

    private function keypad(): array
    {
        return [
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9],
        ];
    }

    private function keypad2(): array
    {
        return [
            [null, null, 1, null, null],
            [null, 2, 3, 4, null],
            [5, 6, 7, 8, 9],
            [null, 'A', 'B', 'C', null],
            [null, null, 'D', null, null],
        ];
    }

    private function move(array $position, string $direction, array $keypad): array
    {
        $x = $position[0];
        $y = $position[1];

        switch ($direction) {
            case 'U':
                $y = max(0, $y - 1);
                break;
            case 'D':
                $y = min(count($keypad) - 1, $y + 1);
                break;
            case 'L':
                $x = max(0, $x - 1);
                break;
            case 'R':
                $x = min(count($keypad[$y]) - 1, $x + 1);
                break;
        }

        // Only update position if within bounds of the keypad layout
        if ($keypad[$y][$x] !== null) {
            $position = [$x, $y];
        }

        return $position;
    }
}
