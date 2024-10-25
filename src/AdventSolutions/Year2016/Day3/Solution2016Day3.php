<?php

namespace App\AdventSolutions\Year2016\Day3;

use App\AdventSolutions\AbstractSolution;

class Solution2016Day3 extends AbstractSolution
{
    public function solvePart1($input): string
    {
        $validTriangles = 0;

        foreach ($input as $line) {
            // Parse the line into an array of integers by splitting on whitespace
            $sides = array_map('intval', preg_split('/\s+/', trim($line)));

            // Sort the sides in ascending order
            sort($sides);

            // Check if the smallest two sides add up to more than the largest side
            if ($sides[0] + $sides[1] > $sides[2]) {
                $validTriangles++;
            }
        }

        return "The number of valid triangles is: <info>$validTriangles</info>";
    }

    public function solvePart2($input): string
    {
        $validTriangles = 0;

        // Group every three lines together to process columns
        foreach (array_chunk($input, 3) as $group) {
            // Convert each line in the group to an array of sides
            $sides = array_map(function ($line) {
                return array_map('intval', preg_split('/\s+/', trim($line)));
            }, $group);

            // Check each column as a separate triangle
            for ($i = 0; $i < 3; $i++) {
                $triangle = [$sides[0][$i], $sides[1][$i], $sides[2][$i]];
                sort($triangle);

                if ($triangle[0] + $triangle[1] > $triangle[2]) {
                    $validTriangles++;
                }
            }
        }

        return "The number of valid triangles (column-wise) is: <info>$validTriangles</info>";
    }
}
