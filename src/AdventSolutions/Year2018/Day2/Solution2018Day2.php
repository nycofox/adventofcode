<?php

namespace App\AdventSolutions\Year2018\Day2;

use App\AdventSolutions\AbstractSolution;

class Solution2018Day2 extends AbstractSolution
{
    public function solvePart1($input): string
    {
        $twoCount = 0;
        $threeCount = 0;

        foreach ($input as $string) {
            if ($this->hasExactlyTwoOfAnyLetter($string)) {
                $twoCount++;
            }

            if ($this->hasExactlyThreeOfAnyLetter($string)) {
                $threeCount++;
            }
        }

        $checksum = $twoCount * $threeCount;
        
        return "The checksum is: <info>$checksum</info>";
    }

    public function solvePart2($input): string
    {
        foreach ($input as $string) {
            foreach ($input as $string2) {
                if ($this->differByOneCharacter($string, $string2)) {
                    $commonLetters = '';

                    for ($i = 0; $i < strlen($string); $i++) {
                        if ($string[$i] === $string2[$i]) {
                            $commonLetters .= $string[$i];
                        }
                    }

                    return "The common letters are: <info>$commonLetters</info>";
                }
            }
        }

        return "No common letters found";
    }

    private function hasExactlyTwoOfAnyLetter(string $string): bool
    {
        $letters = str_split($string);

        foreach ($letters as $letter) {
            if (substr_count($string, $letter) === 2) {
                return true;
            }
        }

        return false;
    }

    private function hasExactlyThreeOfAnyLetter(string $string): bool
    {
        $letters = str_split($string);

        foreach ($letters as $letter) {
            if (substr_count($string, $letter) === 3) {
                return true;
            }
        }

        return false;
    }

    private function differByOneCharacter(string $string1, string $string2): bool
    {
        $differences = 0;

        for ($i = 0; $i < strlen($string1); $i++) {
            if ($string1[$i] !== $string2[$i]) {
                $differences++;
            }
        }

        return $differences === 1;
    }
}