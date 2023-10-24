<?php

namespace App\AdventSolutions\Year2021\Day2;

use App\AdventSolutions\AbstractSolution;

class Solution2021Day2 extends AbstractSolution
{
    public function solvePart1($input): string
    {
        $currentDepth = 0;
        $currentPosition = 0;

        foreach ($input as $instruction)
        {
            $direction = $this->getDirection($instruction);
            $distance = $this->getDistance($instruction);

            switch ($direction)
            {
                case "down":
                    $currentDepth += $distance;
                    break;
                case "up":
                    $currentDepth -= $distance;
                    break;
                case "forward":
                    $currentPosition += $distance;
                    break;
            }
        }

        $answer = $currentDepth * $currentPosition;
        
        return "The answer is: <info>$answer</info>";
    }

    public function solvePart2($input): string
    {
        $currentAim = 0;
        $currentPosition = 0;
        $currentDepth = 0;

        foreach ($input as $instruction)
        {
            $command = $this->getDirection($instruction);
            $value = $this->getDistance($instruction);

            switch ($command)
            {
                case "down":
                    $currentAim += $value;
                    break;
                case "up":
                    $currentAim -= $value;
                    break;
                case "forward":
                    $currentPosition += $value;
                    $currentDepth += $currentAim * $value;
                    break;
            }
        }

        $answer = $currentDepth * $currentPosition;

        return "The answer is: <info>$answer</info>";
    }

    private function getDirection($input): string
    {
        return explode(" ", $input)[0];

    }

    private function getDistance($input): int
    {
        return explode(" ", $input)[1];
    }
}