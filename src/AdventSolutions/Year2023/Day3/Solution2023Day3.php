<?php

namespace App\AdventSolutions\Year2023\Day3;

use App\AdventSolutions\AbstractSolution;

class Solution2023Day3 extends AbstractSolution
{
    private array $input;

    public function solvePart1($input): string
    {
        $this->input = $input;
        $sumNumbersWithAdjacentSymbols = 0;

        foreach ($this->findNumbers() as $number) {
            if ($this->hasAdjacentSymbol($number)) {
                $sumNumbersWithAdjacentSymbols += (int)$number['number'];
            }
        }

        return "Sum of all numbers with adjacent symbol: <info>$sumNumbersWithAdjacentSymbols</info>";
    }


    public function solvePart2($input): string
    {
        $this->input = $input;
        $totalGearRatioSum = 0;

        for ($line = 0; $line < count($input); $line++) {
            for ($position = 0; $position < strlen($input[$line]); $position++) {
                if ($input[$line][$position] === '*') {
                    $gearRatio = $this->calculateGearRatio($line, $position);
                    if ($gearRatio !== null) {
                        $totalGearRatioSum += $gearRatio;
                    }
                }
            }
        }

        return "Sum of all gear ratios: <info>$totalGearRatioSum</info>";
    }

    private function findNumbers(): array
    {
        $numbers = [];
        $number = '';
        $startPosition = null;

        foreach ($this->input as $index => $line) {
            for ($position = 0; $position < strlen($line); $position++) {
                if (is_numeric($line[$position])) {
                    if ($startPosition === null) {
                        $startPosition = $position;
                    }
                    $number .= $line[$position];
                } else {
                    if ($startPosition !== null) {
                        $numbers[] = [
                            'number' => $number,
                            'start_position' => $startPosition,
                            'line' => $index,
                        ];
                        $number = '';
                        $startPosition = null;
                    }
                }
            }

            // Handle case where the line ends with a number
            if ($startPosition !== null) {
                $numbers[] = [
                    'number' => $number,
                    'start_position' => $startPosition,
                    'line' => $index,
                ];
            }

            $number = '';
            $startPosition = null;
        }

        return $numbers;
    }

    private function isSymbol($index, $position): bool
    {
        return isset($this->input[$index][$position]) &&
            !is_numeric($this->input[$index][$position]) &&
            $this->input[$index][$position] !== '.';
    }

    private function hasAdjacentSymbol($number): bool
    {
        $startPosition = $number['start_position'] - 1;
        $endPosition = $number['start_position'] + strlen($number['number']);
        $line = $number['line'];

        // Check top row
        for ($position = $startPosition; $position <= $endPosition; $position++) {
            if ($this->isSymbol($line - 1, $position)) {
                return true;
            }
        }

        // Check bottom row
        for ($position = $startPosition; $position <= $endPosition; $position++) {
            if ($this->isSymbol($line + 1, $position)) {
                return true;
            }
        }

        // Check left
        if ($this->isSymbol($line, $startPosition)) {
            return true;
        }

        // Check right
        if ($this->isSymbol($line, $endPosition)) {
            return true;
        }

        return false;
    }

    private function calculateGearRatio($line, $position): ?int
    {
        $adjacentNumbers = [];

        // Define positions around the `*` symbol, including diagonals
        $adjacentPositions = [
            [$line - 1, $position],        // above
            [$line + 1, $position],        // below
            [$line, $position - 1],        // left
            [$line, $position + 1],        // right
            [$line - 1, $position - 1],    // top-left
            [$line - 1, $position + 1],    // top-right
            [$line + 1, $position - 1],    // bottom-left
            [$line + 1, $position + 1]     // bottom-right
        ];

        foreach ($adjacentPositions as [$adjLine, $adjPos]) {
            if (isset($this->input[$adjLine][$adjPos]) && is_numeric($this->input[$adjLine][$adjPos])) {
                $fullNumber = $this->getFullNumber($adjLine, $adjPos);

                // Add to adjacent numbers only if unique
                if (!in_array($fullNumber, $adjacentNumbers)) {
                    $adjacentNumbers[] = $fullNumber;
                }
            }
        }

        // Check for exactly two adjacent numbers
        if (count($adjacentNumbers) === 2) {
            $gearRatio = $adjacentNumbers[0] * $adjacentNumbers[1];
            echo "Found gear at ($line, $position) with adjacent numbers {$adjacentNumbers[0]} and {$adjacentNumbers[1]}, Gear ratio: $gearRatio\n";
            return $gearRatio;
        }

        return null; // Not a valid gear
    }


    private function getFullNumber($line, $position): int
    {
        $numberStart = $position;
        $numberEnd = $position;

        // Extend to the start of the full number
        while ($numberStart > 0 && is_numeric($this->input[$line][$numberStart - 1])) {
            $numberStart--;
        }

        // Extend to the end of the full number
        while ($numberEnd < strlen($this->input[$line]) - 1 && is_numeric($this->input[$line][$numberEnd + 1])) {
            $numberEnd++;
        }

        return (int)substr($this->input[$line], $numberStart, $numberEnd - $numberStart + 1);
    }
}
