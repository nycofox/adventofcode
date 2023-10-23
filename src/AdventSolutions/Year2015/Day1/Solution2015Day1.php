<?php

namespace App\AdventSolutions\Year2015\Day1;

use App\AdventSolutions\AbstractSolution;

class Solution2015Day1 extends AbstractSolution
{
    public function solvePart1(array $input): string
    {
        $up = substr_count($input[0], '(');
        $down = substr_count($input[0], ')');

        return "Santa is currently on floor <info>" . $up - $down . "</info>.";
    }

    public function solvePart2(array $input): string
    {
        $floor = 0;
        $position = 0;

        foreach (str_split($input[0]) as $char) {
            $position++;
            if ($char === '(') {
                $floor++;
            } else {
                $floor--;
            }

            if ($floor === -1) {
                return "Santa first enters the basement at position <info>$position</info>.";
            }
        }

        return "Santa never enters the basement.";
    }

}