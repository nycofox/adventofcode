<?php

namespace App\AdventSolutions\Year2015\Day4;

class Solution2015Day4
{
    public function solvePart1($input)
    {
        return $this->findHashWithPrefix($input, '00000');
    }

    public function solvePart2($input)
    {
        return $this->findHashWithPrefix($input, '000000');
    }

    private function findHashWithPrefix($input, $prefix)
    {
        $start = $input[0];
        $i = 0;

        while (true) {
            $hash = md5($start . $i);

            if (str_starts_with($hash, $prefix)) {
                return "The number is: <info>$i</info> with hash: <info>$hash</info>";
            }

            $i++;
        }
    }
}