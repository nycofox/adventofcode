<?php

namespace App\AdventSolutions\Year2023\Day3;

use App\AdventSolutions\AbstractSolution;

class Solution2023Day3 extends AbstractSolution
{

    private array $input;

    public function solvePart1($input): string
    {
        $this->input = $input;

        $numbers = $this->findNumbers();

        $sum_numbers_with_adjacent_symbols = 0;

        foreach ($numbers as $number) {
            if ($this->hasAdjacentSymbol($number)) {
                $sum_numbers_with_adjacent_symbols += (int)$number['number'];
                print_r('Found number ' . $number['number'] . ' on line ' . $number['line']+1 .
                    ' with adjacent symbol. Part sum: ' . $sum_numbers_with_adjacent_symbols . PHP_EOL);
            }
        }

        return "Sum of all numbers with adjacent symbol: <info>$sum_numbers_with_adjacent_symbols</info>";
    }

    public function solvePart2($input): string
    {
        // Implement the logic for solving part 2 here

        return "Part 2 not yet implemented!";
    }

    private function findNumbers(): array
    {
        $numbers = [];
        $number = '';
        $start_position = null;

        foreach ($this->input as $index => $line) {
            for ($position = 0; $position < strlen($line); $position++) {
                if (is_numeric($line[$position])) {
                    if ($start_position === null) {
                        $start_position = $position;
                    }
                    $number .= $line[$position];
                } else {
                    if ($start_position !== null) {
                        $numbers[] = [
                            'number' => $number,
                            'start_position' => $start_position,
                            'line' => $index,
                        ];
                    }

                    $number = '';
                    $start_position = null;
                }
            }
        }

        return $numbers;
    }

    private function isSymbol($index, $position): bool
    {
        // check if index exists
        if (!isset($this->input[$index])) {
            return false;
        }

        // check if position exists
        if (!isset($this->input[$index][$position])) {
            return false;
        }

        // check if character is . or a number
        if ($this->input[$index][$position] == '.' || is_numeric($this->input[$index][$position])) {
            return false;
        }

        return true;
    }

    private function hasAdjacentSymbol($number): bool
    {
        $start_position = $number['start_position'] - 1;
        $end_position = strlen($number['number']) + $start_position + 1;
        $line = $number['line'];

        // check top
        for ($position = $start_position; $position <= $end_position; $position++) {
            if ($this->isSymbol($line - 1, $position)) {
                return true;
            }
        }

        // check bottom
        for ($position = $start_position; $position <= $end_position; $position++) {
            if ($this->isSymbol($line + 1, $position)) {
                return true;
            }
        }

        // check left
        if ($this->isSymbol($line, $start_position)) {
            return true;
        }

        // check right
        if ($this->isSymbol($line, $end_position)) {
            return true;
        }

        return false;
    }
}