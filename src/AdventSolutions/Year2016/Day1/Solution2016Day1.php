<?php

namespace App\AdventSolutions\Year2016\Day1;

use App\AdventSolutions\AbstractSolution;

class Solution2016Day1 extends AbstractSolution
{
    public function solvePart1($input): string
    {
        $instructions = $this->parseInput($input);
        [$x, $y] = $this->followInstructions($instructions);

        // Calculate the distance from the starting point (0, 0)
        $distance = abs($x) + abs($y);

        return "The shortest path to the destination is: <info>$distance</info> blocks";
    }

    public function solvePart2($input): string
    {
        $instructions = $this->parseInput($input);
        $distance = $this->findFirstRepeatedLocation($instructions);

        return "The first location visited twice is: <info>$distance</info> blocks away";
    }

    private function parseInput($input): array
    {
        // Split the input string into an array of instructions
        return explode(', ', trim($input[0]));
    }

    private function followInstructions(array $instructions): array
    {
        // Start at the origin, facing north
        $x = 0;
        $y = 0;
        $facing = 0; // 0 = North, 1 = East, 2 = South, 3 = West

        foreach ($instructions as $instruction) {
            [$facing, $x, $y] = $this->move($instruction, $facing, $x, $y);
        }

        return [$x, $y];
    }

    private function move(string $instruction, int $facing, int $x, int $y): array
    {
        [$facing, $steps] = $this->updateFacingAndSteps($instruction, $facing);

        // Move in the current direction
        switch ($facing) {
            case 0: // North
                $y += $steps;
                break;
            case 1: // East
                $x += $steps;
                break;
            case 2: // South
                $y -= $steps;
                break;
            case 3: // West
                $x -= $steps;
                break;
        }

        return [$facing, $x, $y];
    }

    private function findFirstRepeatedLocation(array $instructions): int
    {
        $x = 0;
        $y = 0;
        $facing = 0;
        $visitedLocations = ["$x,$y"]; // Start by marking the origin as visited

        foreach ($instructions as $instruction) {
            [$facing, $steps] = $this->updateFacingAndSteps($instruction, $facing);

            // Move step by step in the current direction
            for ($i = 0; $i < $steps; $i++) {
                switch ($facing) {
                    case 0: $y += 1; break; // North
                    case 1: $x += 1; break; // East
                    case 2: $y -= 1; break; // South
                    case 3: $x -= 1; break; // West
                }

                $location = "$x,$y";

                // Check if the location has already been visited
                if (in_array($location, $visitedLocations)) {
                    return abs($x) + abs($y);
                }

                // Mark the location as visited
                $visitedLocations[] = $location;
            }
        }

        // Return an error value if no location was visited twice
        return -1; // This shouldn't happen with valid input
    }

    private function updateFacingAndSteps(string $instruction, int $facing): array
    {
        $turn = $instruction[0];
        $steps = intval(substr($instruction, 1));

        // Update the facing direction based on the turn
        if ($turn == 'R') {
            $facing = ($facing + 1) % 4;
        } elseif ($turn == 'L') {
            $facing = ($facing + 3) % 4;
        }

        return [$facing, $steps];
    }
}
