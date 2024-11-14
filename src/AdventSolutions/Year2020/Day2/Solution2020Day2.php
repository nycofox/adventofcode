<?php

namespace App\AdventSolutions\Year2020\Day2;

use App\AdventSolutions\AbstractSolution;

class Solution2020Day2 extends AbstractSolution
{
    public function solvePart1($input): string
    {
        $validPasswords = 0;
        foreach ($input as $line) {
            if (empty($line)) {
                continue;
            }
            [$letter, $min, $max, $password] = $this->getAttributes($line);
            if ($this->isValidPassword($letter, $min, $max, $password)) {
                $validPasswords++;
            }
        }
        return "Number of valid passwords: <info>$validPasswords</info>";
    }

    public function solvePart2($input): string
    {
        $validPasswords = 0;
        foreach ($input as $line) {
            if (empty($line)) {
                continue;
            }
            [$letter, $pos1, $pos2, $password] = $this->getAttributes($line);
            if ($this->isValidPassword2($letter, $pos1, $pos2, $password)) {
                $validPasswords++;
            }
        }
        return "Number of valid passwords: <info>$validPasswords</info>";
    }

    private function isValidPassword($letter, $min, $max, $password)
    {
        $count = substr_count($password, $letter);
        return $count >= $min && $count <= $max;
    }

    private function isValidPassword2($letter, $pos1, $pos2, $password)
    {
        $letter1 = substr($password, $pos1 - 1, 1);
        $letter2 = substr($password, $pos2 - 1, 1);
        return ($letter1 === $letter || $letter2 === $letter) && $letter1 !== $letter2;
    }

    private function getAttributes($line)
    {
        $parts = explode(" ", $line);
        $range = explode("-", $parts[0]);
        $min = (int) $range[0];
        $max = (int) $range[1];
        $letter = substr($parts[1], 0, 1);
        $password = $parts[2];
        return [$letter, $min, $max, $password];
    }
}