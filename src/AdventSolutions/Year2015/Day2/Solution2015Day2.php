<?php

namespace App\AdventSolutions\Year2015\Day2;

class Solution2015Day2
{
    private $totalWrappingPaper = 0;

    private $totalRibbon = 0;

    public function solvePart1($input)
    {
        // Implement the logic for solving part 1 here
        foreach ($input as $dimensions) {
            // split dimensions into length, width, height
            $dimensions = $this->getDimensions($dimensions);

            $this->totalWrappingPaper += $this->calculateWrappingPaper($dimensions[0], $dimensions[1], $dimensions[2]);
        }

        return "Total wrapping paper: <info>" . $this->totalWrappingPaper . "</info>";
    }

    public function solvePart2($input)
    {
        // Implement the logic for solving part 2 here
        foreach ($input as $dimensions) {
            // split dimensions into length, width, height
            $dimensions = $this->getDimensions($dimensions);

            $ordered = $this->order($dimensions);

            $temp = 2 * ($ordered[0] + $ordered[1]);

            $this->totalRibbon += $temp + ($ordered[0] * $ordered[1] * $ordered[2]);
        }

        return "Total ribbon: <info>" . $this->totalRibbon . "</info>";
    }

    private function getDimensions(string $input): array
    {
        return explode('x', $input);
    }

    private function order(array $array): array
    {
        sort($array);

        return $array;
    }

    private function calculateWrappingPaper(int $length, int $width, int $height): int
    {
        // Implement the logic for calculating the wrapping paper here
        $side1 = $length * $width;
        $side2 = $width * $height;
        $side3 = $height * $length;

        $result = 2 * ($side1 + $side2 + $side3);

        // get smallest of the three sides
        $smallest = $this->order([$side1, $side2, $side3])[0];

        return $result + $smallest;
    }

}