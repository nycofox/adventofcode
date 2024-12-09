<?php

namespace App\AdventSolutions\Year2024\Day7;

use App\AdventSolutions\AbstractSolution;

class Solution2024Day7 extends AbstractSolution
{
    public function solvePart1($input, $debug = false): string
    {
        $equations = $this->parseInput($input);
        $totalCalibrationResult = 0;

        foreach ($equations as [$targetValue, $numbers]) {
            if ($this->canProduceTargetWithBasicOperators($targetValue, $numbers)) {
                $totalCalibrationResult += $targetValue;
            }
        }

        return "The total calibration result is: <info>$totalCalibrationResult</info>";
    }

    public function solvePart2($input, $debug = false): string
    {
        $equations = $this->parseInput($input);
        $totalCalibrationResult = 0;

        foreach ($equations as [$targetValue, $numbers]) {
            if ($this->canProduceTargetWithAllOperators($targetValue, $numbers)) {
                $totalCalibrationResult += $targetValue;
            }
        }

        return "The total calibration result with all operators is: <info>$totalCalibrationResult</info>";
    }

    private function parseInput(array $input): array
    {
        $equations = [];
        foreach ($input as $line) {
            [$target, $nums] = explode(':', $line);
            $targetValue = (int)trim($target);
            $numbers = array_map('intval', explode(' ', trim($nums)));
            $equations[] = [$targetValue, $numbers];
        }
        return $equations;
    }

    private function canProduceTargetWithBasicOperators(int $target, array $numbers): bool
    {
        $operatorPermutations = $this->generateBasicOperatorPermutations(count($numbers) - 1);

        foreach ($operatorPermutations as $operators) {
            if ($this->evaluateExpression($numbers, $operators) === $target) {
                return true;
            }
        }

        return false;
    }

    private function canProduceTargetWithAllOperators(int $target, array $numbers): bool
    {
        $operatorPermutations = $this->generateAllOperatorPermutations(count($numbers) - 1);

        foreach ($operatorPermutations as $operators) {
            if ($this->evaluateExpression($numbers, $operators) === $target) {
                return true;
            }
        }

        return false;
    }

    private function generateBasicOperatorPermutations(int $length): array
    {
        return $this->generateOperatorPermutations($length, ['+', '*']);
    }

    private function generateAllOperatorPermutations(int $length): array
    {
        return $this->generateOperatorPermutations($length, ['+', '*', '||']);
    }

    private function generateOperatorPermutations(int $length, array $operators): array
    {
        if ($length === 0) {
            return [[]];
        }

        $results = [];
        $subPermutations = $this->generateOperatorPermutations($length - 1, $operators);

        foreach ($subPermutations as $subPerm) {
            foreach ($operators as $operator) {
                $results[] = array_merge($subPerm, [$operator]);
            }
        }

        return $results;
    }

    private function evaluateExpression(array $numbers, array $operators): int
    {
        $result = $numbers[0];

        for ($i = 0; $i < count($operators); $i++) {
            $nextNumber = $numbers[$i + 1];

            switch ($operators[$i]) {
                case '+':
                    $result += $nextNumber;
                    break;
                case '*':
                    $result *= $nextNumber;
                    break;
                case '||':
                    $result = (int)($result . $nextNumber); // Concatenate as strings and convert back to integer
                    break;
            }
        }

        return $result;
    }
}
