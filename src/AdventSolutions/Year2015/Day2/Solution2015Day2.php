<?php

namespace App\AdventSolutions\Year2015\Day2;

use App\AdventSolutions\AbstractSolution;

class Solution2015Day2 extends AbstractSolution
{
    public function solvePart1($input): string
    {
        $totalWrappingPaper = 0;

        foreach ($input as $dimensions) {
            [$length, $width, $height] = explode('x', $dimensions);
            $totalWrappingPaper += $this->calculateWrappingPaper($length, $width, $height);
        }

        return "Total wrapping paper: <info>$totalWrappingPaper</info>";
    }

    public function solvePart2($input): string
    {
        $totalRibbon = 0;

        foreach ($input as $dimensions) {
            [$length, $width, $height] = explode('x', $dimensions);
            $totalRibbon += $this->calculateRibbon($length, $width, $height);
        }

        return "Total ribbon: <info>$totalRibbon</info>";
    }

    private function calculateWrappingPaper($length, $width, $height)
    {
        $side1 = $length * $width;
        $side2 = $width * $height;
        $side3 = $height * $length;

        $surfaceArea = 2 * ($side1 + $side2 + $side3);

        $smallestSide = min($side1, $side2, $side3);

        return $surfaceArea + $smallestSide;
    }

    private function calculateRibbon($length, $width, $height)
    {
        $sides = [$length, $width, $height];
        sort($sides);

        $smallestPerimeter = 2 * ($sides[0] + $sides[1]);
        $volume = $length * $width * $height;

        return $smallestPerimeter + $volume;
    }
}