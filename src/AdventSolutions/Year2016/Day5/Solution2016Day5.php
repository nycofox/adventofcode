<?php

namespace App\AdventSolutions\Year2016\Day5;

use App\AdventSolutions\AbstractSolution;

class Solution2016Day5 extends AbstractSolution
{
    private const HASH_PREFIX = '00000';
    private const PASSWORD_LENGTH = 8;

    public function solvePart1($input, $debug = false): string
    {
        $string = trim($input[0]);
        $password = '';

        $this->generatePassword($string, function ($hash, &$password) {
            $password .= $hash[5];
            return strlen($password) === self::PASSWORD_LENGTH;
        }, $password);

        return "The password is: <info>$password</info>";
    }

    public function solvePart2($input, $debug = false): string
    {
        $string = trim($input[0]);
        $password = array_fill(0, self::PASSWORD_LENGTH, null);

        $this->generatePassword($string, function ($hash, &$password) {
            $position = $hash[5];
            if (is_numeric($position) && $position < self::PASSWORD_LENGTH && $password[$position] === null) {
                $password[$position] = $hash[6];
            }
            return !in_array(null, $password, true);
        }, $password);

        return "The password is: <info>" . implode('', $password) . "</info>";
    }

    private function generatePassword(string $string, callable $callback, &$password): void
    {
        for ($i = 0; $i < PHP_INT_MAX; $i++) {
            $hash = md5($string . $i);

            if (str_starts_with($hash, self::HASH_PREFIX)) {
                if ($callback($hash, $password)) {
                    break;
                }
            }
        }
    }
}
