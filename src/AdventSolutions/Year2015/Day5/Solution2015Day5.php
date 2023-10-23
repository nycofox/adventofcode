<?php

namespace App\AdventSolutions\Year2015\Day5;

class Solution2015Day5
{

    public function solvePart1($input)
    {
        $niceStrings = 0;

        foreach ($input as $string) {
            if ($this->hasThreeVowels($string) &&
                $this->hasDoubleLetters($string) &&
                !$this->containsBadStrings($string)) {
                $niceStrings++;
            }
        }

        return "There are $niceStrings nice strings.";
    }

    public function solvePart2($input)
    {
        $niceStrings = 0;

        foreach ($input as $string) {
            if ($this->hasRepeatingPair($string) && $this->hasRepeatedLetter($string)) {
                $niceStrings++;
            }
        }

        return "There are $niceStrings nice strings according to Part 2.";
    }

    private function hasThreeVowels($string): bool
    {
        // Define a constant for vowels
        $vowels = 'aeiou';

        // Count the number of vowels in the string
        $vowelCount = 0;

        // Iterate through each character in the string
        for ($i = 0; $i < strlen($string); $i++) {
            // Check if the character is a vowel
            if (str_contains($vowels, $string[$i])) {
                $vowelCount++;
            }

            // If we have found at least three vowels, return true
            if ($vowelCount >= 3) {
                return true;
            }
        }

        // If we didn't find three vowels, return false
        return false;
    }

    private function hasDoubleLetters($string): bool
    {
        // Iterate through each character except the last one
        for ($i = 0; $i < strlen($string) - 1; $i++) {
            // Check if the current character is the same as the next character
            if ($string[$i] === $string[$i + 1]) {
                return true;
            }
        }

        return false;
    }

    private function containsBadStrings($string): bool
    {
        $badStrings = ['ab', 'cd', 'pq', 'xy'];

        foreach ($badStrings as $badString) {
            if (str_contains($string, $badString)) {
                return true;
            }
        }

        return false;
    }

    private function hasRepeatingPair($string): bool
    {
        for ($i = 0; $i < strlen($string) - 2; $i++) {
            $pair = $string[$i] . $string[$i + 1];
            if (strpos($string, $pair, $i + 2) !== false) {
                return true;
            }
        }

        return false;
    }

    private function hasRepeatedLetter($string): bool
    {
        for ($i = 0; $i < strlen($string) - 2; $i++) {
            if ($string[$i] === $string[$i + 2]) {
                return true;
            }
        }

        return false;
    }

}