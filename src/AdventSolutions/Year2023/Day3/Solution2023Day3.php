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

        $numbers_with_symbols = 0;

        foreach ($numbers as $number) {
            if ($this->hasAdjacentSymbol($number)) {
                $numbers_with_symbols += $number['number'];
                print_r('Fant symbol rundt ' . $number['number'] . ' på linje ' . $number['line'] . '. Delsum: ' . $numbers_with_symbols . PHP_EOL);
            }
        }

        return "Sum of all numbers with adjacent symbol: <info>$numbers_with_symbols</info>";
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
                            'end_position' => $position - 1,
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
        $start_position = $number['start_position'];
        $end_position = $number['end_position'];
        $line = $number['line'];

//        print_r($number['number'] . ' på linje ' . $line . ' fra ' . $start_position . ' til ' . $end_position . PHP_EOL);

        // check top
        for ($position = $start_position - 1; $position <= $end_position + 1; $position++) {
//            print_r('Sjekker over på linje ' . $line - 1 . ' posisjon ' . $position . PHP_EOL);
            if ($this->isSymbol($line - 1, $position)) {
//                print_r('Fant symbol over' . PHP_EOL);
                return true;
            }
        }

        // check bottom
        for ($position = $start_position - 1; $position <= $end_position + 1; $position++) {
//            print_r('Sjekker under på linje ' . $line + 1 . ' posisjon ' . $position . PHP_EOL);
            if ($this->isSymbol($line + 1, $position)) {
//                print_r('Fant symbol under' . PHP_EOL);
                return true;
            }
        }

        // check left
        if ($this->isSymbol($line, $start_position - 1)) {
//            print_r('Fant symbol til venstre' . PHP_EOL);
            return true;
        }

        // check right
        if ($this->isSymbol($line, $end_position + 1)) {
//            print_r('Fant symbol til høyre' . PHP_EOL);
            return true;
        }

//        print_r('Fant ikke symbol rundt' . PHP_EOL);
        return false;
    }
}