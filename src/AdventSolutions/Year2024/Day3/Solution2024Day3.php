<?php

namespace App\AdventSolutions\Year2024\Day3;

use App\AdventSolutions\AbstractSolution;

class Solution2024Day3 extends AbstractSolution
{
    public function solvePart1($input, $debug = false): string
    {
        $sum = 0;

        foreach ($input as $line) {
            $multipliers = $this->getMultipliers($line);
            foreach ($multipliers[1] as $key => $value) {
                $sum += $value * $multipliers[2][$key];
            }
        }

        return "Sum of all multiplications: <info>$sum</info>";
    }

    public function solvePart2($input, $debug = false): string
    {
        $sum = 0;
        $do = true;

        foreach ($input as $line) {
            $instructions = $this->getMultipliersWithDoAndDont($line);


            foreach ($instructions as $instruction) {
                if ($instruction[0] === 'mul' && $do) {
                    $sum += $instruction[1] * $instruction[2];
                }

                if ($instruction[0] === 'do()') {
                    $do = true;
                }

                if ($instruction[0] === "don't()") {
                    $do = false;
                }
            }
        }
        return "Sum of all multiplications (with do and don't): <info>$sum</info>";
    }

    private function getMultipliers($string): array
    {
        preg_match_all('/mul\((\d+),(\d+)\)/', $string, $matches);
        return $matches;
    }

    private function getMultipliersWithDoAndDont($string): array
    {
        preg_match_all('/mul\((\d+),(\d+)\)|do\(\)|don\'t\(\)/', $string, $matches, PREG_SET_ORDER);

        $instructions = [];
        foreach ($matches as $match) {
            if (isset($match[1]) && isset($match[2])) {
                $instructions[] = ['mul', (int)$match[1], (int)$match[2]]; // Capture mul(x,y)
            } elseif ($match[0] === 'do()') {
                $instructions[] = ['do()']; // Capture do()
            } elseif ($match[0] === "don't()") {
                $instructions[] = ["don't()"]; // Capture don't()
            }
        }

        return $instructions;
    }
}