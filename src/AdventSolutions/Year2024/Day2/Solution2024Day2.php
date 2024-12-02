<?php

namespace App\AdventSolutions\Year2024\Day2;

use App\AdventSolutions\AbstractSolution;

class Solution2024Day2 extends AbstractSolution
{
    public function solvePart1($input, $debug = false): string
    {
        $safeReports = 0;

        foreach ($input as $line) {
            if ($this->isSafe($this->getLevels($line))) {
                $safeReports++;
            }
        }

        return "Number of safe reports: <info>$safeReports</info>";
    }

    public function solvePart2($input, $debug = false): string
    {
        $safeReports = 0;

        foreach ($input as $line) {
            if ($this->isSafe($this->getLevels($line), 1)) {
                $safeReports++;
            }
        }

        return "Number of safe reports (with dampeners): <info>$safeReports</info>";
    }

    private function getLevels($line)
    {
        return explode(" ", $line);
    }

    private function isSafe($levels, $ignoreLevels = 0): bool
    {
        if (count($levels) < 2) {
            return true; // A single level or empty array is trivially safe
        }

        // Helper function to validate the sequence
        $isValid = function ($levels) {
            return $this->isValid($levels);
        };

        // If no levels are to be ignored, check the sequence directly
        if ($ignoreLevels === 0) {
            return $isValid($levels);
        }

        // Try ignoring up to $ignoreLevels and check if the sequence is valid
        foreach ($levels as $index => $level) {
            $modified = $levels;
            unset($modified[$index]); // Ignore one level
            $modified = array_values($modified); // Re-index the array

            if ($this->isSafe($modified, $ignoreLevels - 1)) {
                return true; // Sequence is safe by ignoring up to the specified levels
            }
        }

        return false; // No valid sequence found
    }

    private function isValid($levels): bool
    {
        $isIncreasing = $levels[1] > $levels[0];
        for ($i = 0; $i < count($levels) - 1; $i++) {
            $diff = $levels[$i + 1] - $levels[$i];
            if ($isIncreasing) {
                if ($diff <= 0 || $diff > 3) {
                    return false;
                }
            } else {
                if ($diff >= 0 || $diff < -3) {
                    return false;
                }
            }
        }
        return true;
    }
}