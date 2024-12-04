<?php

namespace App\AdventSolutions\Year2024\Day4;

use App\AdventSolutions\AbstractSolution;

class Solution2024Day4 extends AbstractSolution
{
    public function solvePart1($input, $debug = false): string
    {
        $grid = $this->parseGrid($input);
        $word = "XMAS";
        $occurrences = $this->countWordOccurrences($grid, $word);

        return "The total occurrences of XMAS are: <info>$occurrences</info>";
    }

    public function solvePart2($input, $debug = false): string
    {
        $grid = $this->parseGrid($input);
        $occurrences = $this->countXMasOccurrences($grid);

        return "The total occurrences of X-MAS are: <info>$occurrences</info>";
    }

    private function parseGrid(array $input): array
    {
        return array_map('str_split', $input);
    }

    private function countWordOccurrences(array $grid, string $word): int
    {
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

        $rows = count($grid);
        $cols = count($grid[0]);
        $wordLength = strlen($word);
        $occurrences = 0;

        for ($r = 0; $r < $rows; $r++) {
            for ($c = 0; $c < $cols; $c++) {
                foreach ($directions as [$rowOffset, $colOffset]) {
                    if ($this->checkWord($grid, $r, $c, $word, $rowOffset, $colOffset, $wordLength, $rows, $cols)) {
                        $occurrences++;
                    }
                }
            }
        }

        return $occurrences;
    }

    private function countXMasOccurrences(array $grid): int
    {
        $rows = count($grid);
        $cols = count($grid[0]);
        $occurrences = 0;

        for ($r = 1; $r < $rows - 1; $r++) {
            for ($c = 1; $c < $cols - 1; $c++) {
                if ($grid[$r][$c] === 'A' && $this->isXMas($grid, $r, $c)) {
                    $occurrences++;
                }
            }
        }

        return $occurrences;
    }

    private function checkWord(array $grid, int $startRow, int $startCol, string $word, int $rowOffset, int $colOffset, int $wordLength, int $rows, int $cols): bool
    {
        for ($i = 0; $i < $wordLength; $i++) {
            $r = $startRow + $i * $rowOffset;
            $c = $startCol + $i * $colOffset;

            if ($r < 0 || $r >= $rows || $c < 0 || $c >= $cols || $grid[$r][$c] !== $word[$i]) {
                return false;
            }
        }

        return true;
    }

    private function isXMas(array $grid, int $centerRow, int $centerCol): bool
    {
        $positions = [
            'topLeft' => [$centerRow - 1, $centerCol - 1],
            'topRight' => [$centerRow - 1, $centerCol + 1],
            'bottomLeft' => [$centerRow + 1, $centerCol - 1],
            'bottomRight' => [$centerRow + 1, $centerCol + 1],
        ];

        $chars = [
            'topLeft' => $grid[$positions['topLeft'][0]][$positions['topLeft'][1]] ?? null,
            'topRight' => $grid[$positions['topRight'][0]][$positions['topRight'][1]] ?? null,
            'bottomLeft' => $grid[$positions['bottomLeft'][0]][$positions['bottomLeft'][1]] ?? null,
            'bottomRight' => $grid[$positions['bottomRight'][0]][$positions['bottomRight'][1]] ?? null,
        ];

        $validMas = ['MAS', 'SAM'];

        $diagonal1 = $chars['topLeft'] . $grid[$centerRow][$centerCol] . $chars['bottomRight'];
        $diagonal2 = $chars['bottomLeft'] . $grid[$centerRow][$centerCol] . $chars['topRight'];

        return in_array($diagonal1, $validMas) && in_array($diagonal2, $validMas);
    }
}
