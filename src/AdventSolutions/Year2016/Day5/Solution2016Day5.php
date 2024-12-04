<?php

namespace App\AdventSolutions\Year2016\Day5;

use App\AdventSolutions\AbstractSolution;

class Solution2016Day5 extends AbstractSolution
{
    public function solvePart1($input, $debug = false): string
    {
        $string = trim($input[0]);
        $password = '';

        for ($i = 0; $i < PHP_INT_MAX; $i++) {
            $hash = md5($string . $i);

            if (str_starts_with($hash, '00000')) {
                $password .= $hash[5];

                if (strlen($password) === 8) {
                    break;
                }
            }
        }
        
        return "The password is: <info>$password</info>";
    }

    public function solvePart2($input, $debug = false): string
    {
        $string = trim($input[0]);
        $password = array_fill(0, 8, null);

        for ($i = 0; $i < PHP_INT_MAX; $i++) {
            $hash = md5($string . $i);

            if (str_starts_with($hash, '00000')) {
                $position = $hash[5];

                if (is_numeric($position) && $position < 8 && $password[$position] === null) {
                    $password[$position] = $hash[6];

                    if (!in_array(null, $password)) {
                        break;
                    }
                }
            }
        }

        return "The password is: <info>" . implode('', $password) . "</info>";
    }
}