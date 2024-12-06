<?php

namespace App\AdventSolutions\Year2024\Day6;

use App\AdventSolutions\AbstractSolution;

class Solution2024Day6 extends AbstractSolution
{
    private const DIRECTIONS = [
        'up' => [-1, 0],
        'right' => [0, 1],
        'down' => [1, 0],
        'left' => [0, -1],
    ];

    public function solvePart1($input, $debug = false): string
    {
        $map = $this->parseMap($input);
        [$guardPos, $guardDir] = $this->findGuard($map);

        $visitedPositions = $this->simulateGuardMovement($map, $guardPos, $guardDir);

        return "The guard visits <info>" . count($visitedPositions) . "</info> distinct positions.";
    }

    public function solvePart2($input, $debug = false): string
    {
        $map = $this->parseMap($input);
        [$guardPos, $guardDir] = $this->findGuard($map);

        $openPositions = $this->findOpenPositions($map, $guardPos);
        $validObstructions = $this->countValidObstructions($map, $guardPos, $guardDir, $openPositions);

        return "The number of valid obstruction positions is: <info>$validObstructions</info>";
    }

    private function parseMap(array $input): array
    {
        return array_map('str_split', $input);
    }

    /**
     * @throws \Exception
     */
    private function findGuard(array $map): array
    {
        $guardSymbols = ['^' => 'up', '>' => 'right', 'v' => 'down', '<' => 'left'];

        foreach ($map as $row => $line) {
            foreach ($line as $col => $cell) {
                if (isset($guardSymbols[$cell])) {
                    return [[$row, $col], $guardSymbols[$cell]];
                }
            }
        }

        throw new \Exception("Guard not found on the map!");
    }

    private function simulateGuardMovement(array $map, array $guardPos, string $guardDir): array
    {
        $rows = count($map);
        $cols = count($map[0]);
        $visited = [$guardPos];
        $visitedSet = [implode(',', $guardPos) => true];

        while (true) {
            [$rowOffset, $colOffset] = self::DIRECTIONS[$guardDir];
            $nextPos = [$guardPos[0] + $rowOffset, $guardPos[1] + $colOffset];

            if ($this->isOutOfBounds($nextPos, $rows, $cols)) {
                break; // Guard leaves the map
            }

            if ($this->isObstructed($map, $nextPos)) {
                $guardDir = $this->turnRight($guardDir);
            } else {
                $guardPos = $nextPos;
                $key = implode(',', $guardPos);

                if (!isset($visitedSet[$key])) {
                    $visited[] = $guardPos;
                    $visitedSet[$key] = true;
                }
            }
        }

        return $visited;
    }

    private function isOutOfBounds(array $pos, int $rows, int $cols): bool
    {
        return $pos[0] < 0 || $pos[0] >= $rows || $pos[1] < 0 || $pos[1] >= $cols;
    }

    private function isObstructed(array $map, array $pos): bool
    {
        return $map[$pos[0]][$pos[1]] === '#';
    }

    private function findOpenPositions(array $map, array $guardPos): array
    {
        $openPositions = [];

        foreach ($map as $row => $line) {
            foreach ($line as $col => $cell) {
                if ($cell === '.' && [$row, $col] !== $guardPos) {
                    $openPositions[] = [$row, $col];
                }
            }
        }

        return $openPositions;
    }

    private function countValidObstructions(array $map, array $guardPos, string $guardDir, array $openPositions): int
    {
        $validCount = 0;

        foreach ($openPositions as $obstruction) {
            if ($this->causesLoop($map, $guardPos, $guardDir, $obstruction)) {
                $validCount++;
            }
        }

        return $validCount;
    }

    private function causesLoop(array $map, array $guardPos, string $guardDir, array $obstruction): bool
    {
        $map[$obstruction[0]][$obstruction[1]] = '#'; // Temporarily place the obstruction
        $visitedStates = [];

        $rows = count($map);
        $cols = count($map[0]);

        while (true) {
            $state = implode(',', $guardPos) . ',' . $guardDir;

            if (isset($visitedStates[$state])) {
                return true; // Loop detected
            }

            $visitedStates[$state] = true;

            [$rowOffset, $colOffset] = self::DIRECTIONS[$guardDir];
            $nextPos = [$guardPos[0] + $rowOffset, $guardPos[1] + $colOffset];

            if ($this->isOutOfBounds($nextPos, $rows, $cols)) {
                break; // Guard leaves the map
            }

            if ($this->isObstructed($map, $nextPos)) {
                $guardDir = $this->turnRight($guardDir);
            } else {
                $guardPos = $nextPos;
            }
        }

        return false;
    }

    private function turnRight(string $currentDir): string
    {
        $directionOrder = ['up' => 'right', 'right' => 'down', 'down' => 'left', 'left' => 'up'];
        return $directionOrder[$currentDir];
    }
}
