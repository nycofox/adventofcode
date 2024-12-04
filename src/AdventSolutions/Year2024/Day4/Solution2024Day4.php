<?php

namespace App\AdventSolutions\Year2024\Day4;

use App\AdventSolutions\AbstractSolution;

class Solution2024Day4 extends AbstractSolution
{
    public function solvePart1($input, $debug = false): string
    {
        $grid = array_map('str_split', $input); // Convert each line into an array of characters
        $word = "XMAS";
        $wordLength = strlen($word);
        $occurrences = 0;

        $rows = count($grid);
        $cols = count($grid[0]); // Assuming all rows are of equal length

        // Define all directions as [row_offset, col_offset]
        $directions = [
            [0, 1],   // Right
            [0, -1],  // Left
            [1, 0],   // Down
            [-1, 0],  // Up
            [1, 1],   // Diagonal down-right
            [-1, -1], // Diagonal up-left
            [1, -1],  // Diagonal down-left
            [-1, 1],  // Diagonal up-right
        ];

        // Iterate through each position in the grid
        for ($r = 0; $r < $rows; $r++) {
            for ($c = 0; $c < $cols; $c++) {
                // Check all directions
                foreach ($directions as [$rowOffset, $colOffset]) {
                    if ($this->checkWord($grid, $r, $c, $word, $rowOffset, $colOffset, $wordLength, $rows, $cols)) {
                        $occurrences++;
                    }
                }
            }
        }

        return "The total occurrences of XMAS are: <info>$occurrences</info>";
    }

    public function solvePart2($input, $debug = false): string
    {
        $grid = array_map('str_split', $input); // Convert each line into an array of characters
        $occurrences = 0;

        $rows = count($grid);
        $cols = count($grid[0]); // Assuming all rows are of equal length

        // Iterate through each position in the grid
        for ($r = 1; $r < $rows - 1; $r++) {
            for ($c = 1; $c < $cols - 1; $c++) {
                // Check if the position can be the center of an X-MAS
                if ($grid[$r][$c] === 'A' && $this->isXMas($grid, $r, $c)) {
                    $occurrences++;
                }
            }
        }

        return "The total occurrences of X-MAS are: <info>$occurrences</info>";
    }

    private function checkWord($grid, $startRow, $startCol, $word, $rowOffset, $colOffset, $wordLength, $rows, $cols): bool
    {
        for ($i = 0; $i < $wordLength; $i++) {
            $r = $startRow + $i * $rowOffset;
            $c = $startCol + $i * $colOffset;

            // Check if the position is out of bounds
            if ($r < 0 || $r >= $rows || $c < 0 || $c >= $cols) {
                return false;
            }

            // Check if the character matches
            if ($grid[$r][$c] !== $word[$i]) {
                return false;
            }
        }

        return true; // All characters matched
    }

    private function isXMas($grid, $centerRow, $centerCol): bool
    {
        // Check the four surrounding positions
        $topLeft = [$centerRow - 1, $centerCol - 1];
        $topRight = [$centerRow - 1, $centerCol + 1];
        $bottomLeft = [$centerRow + 1, $centerCol - 1];
        $bottomRight = [$centerRow + 1, $centerCol + 1];

        // Extract characters
        $topLeftChar = $grid[$topLeft[0]][$topLeft[1]] ?? null;
        $topRightChar = $grid[$topRight[0]][$topRight[1]] ?? null;
        $bottomLeftChar = $grid[$bottomLeft[0]][$bottomLeft[1]] ?? null;
        $bottomRightChar = $grid[$bottomRight[0]][$bottomRight[1]] ?? null;

        // Define valid patterns for "MAS" (forwards and backwards)
        $validMas = ['MAS', 'SAM'];

        // Check if the diagonals form an X-MAS
        $diagonal1 = $topLeftChar . $grid[$centerRow][$centerCol] . $bottomRightChar;
        $diagonal2 = $bottomLeftChar . $grid[$centerRow][$centerCol] . $topRightChar;

        return in_array($diagonal1, $validMas) && in_array($diagonal2, $validMas);
    }
}