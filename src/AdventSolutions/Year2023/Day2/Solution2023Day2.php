<?php

namespace App\AdventSolutions\Year2023\Day2;

use App\AdventSolutions\AbstractSolution;

class Solution2023Day2 extends AbstractSolution
{
    const RED_MAX = 12;
    const GREEN_MAX = 13;
    const BLUE_MAX = 14;

    public function solvePart1($input): string
    {
        $sum = 0;

        foreach ($input as $game) {
            $gameId = $this->getGameId($game);

            $maxValues = $this->findMaxValues($game);

            if ($this->gameIsValid($maxValues)) {
                $sum += $gameId;
            }

        }

        return "Sum of valid games: <info>$sum</info>";
    }

    public function solvePart2($input): string
    {
        $sum = 0;

        foreach ($input as $game) {
            $maxValues = $this->findMaxValues($game);

            $power = $maxValues['red'] * $maxValues['green'] * $maxValues['blue'];

            $sum += $power;
        }

        return "The sum of the power of all games is: <info>$sum</info>";
    }

    private function gameIsValid($colorMax): bool
    {
        if ($colorMax['red'] > self::RED_MAX || $colorMax['green'] > self::GREEN_MAX || $colorMax['blue'] > self::BLUE_MAX) {
            return false;
        }

        return true;
    }

    private function getGameId($game): int
    {
        $strArray = explode(' ', $game);

        return (int)$strArray[1];
    }

    function findMaxValues($str) {
        preg_match_all('/(\d+) (red|green|blue)/', $str, $matches, PREG_SET_ORDER);

        $maxValues = [
            'red' => 0,
            'green' => 0,
            'blue' => 0
        ];

        foreach ($matches as $match) {
            $value = intval($match[1]);
            $color = $match[2];

            if ($value > $maxValues[$color]) {
                $maxValues[$color] = $value;
            }
        }

        return $maxValues;
    }
}