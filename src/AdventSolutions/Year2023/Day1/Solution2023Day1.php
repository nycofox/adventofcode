<?php

namespace App\AdventSolutions\Year2023\Day1;

use App\AdventSolutions\AbstractSolution;

class Solution2023Day1 extends AbstractSolution
{
    public function solvePart1($input): string
    {
        $sum = 0;

        foreach ($input as $item) {
            $numbers = $this->removeNonNumbers($item);

            $sum += intval($this->getFirstAndLastNumber($numbers));
        }

        return "The sum of all numbers is: <info>$sum</info>";
    }

    public function solvePart2($input): string
    {
        $sum = 0;

        foreach ($input as $item) {
            $numbers = $this->convertNumberWordsToNumbers($item);
            $numbers = $this->removeNonNumbers($numbers);

            $sum += intval($this->getFirstAndLastNumber($numbers));

            print_r($item . ": " . $numbers . " - " . $this->getFirstAndLastNumber($numbers) . "\n");

        }

        return "The sum of all numbers (with word numbers) is: <info>$sum</info>";
    }

    private function convertNumberWordsToNumbers($input)
    {
        $numberWords = [
            // Stupid fix because of the way the input is formatted
            'oneight' => '18',
            'twone' => '21',
            'threeight' => '38',
            'fiveight' => '58',
            'sevenine' => '79',
            'eightwo' => '82',
            'eighthree' => '83',
            'nineight' => '98',

            'one' => '1', 'two' => '2', 'three' => '3', 'four' => '4', 'five' => '5',
            'six' => '6', 'seven' => '7', 'eight' => '8', 'nine' => '9',
        ];

        foreach ($numberWords as $word => $number) {
            $input = str_ireplace($word, $number, $input);
        }

        return $input;
    }

    private function removeNonNumbers($input)
    {
        return preg_replace("/[^0-9]/", "", $input);
    }

    private function getFirstAndLastNumber($input): string
    {
        $firstNumber = substr($input, 0, 1);
        $lastNumber = substr($input, -1);

        return $firstNumber . $lastNumber;
    }
}