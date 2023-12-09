<?php

namespace App\AdventSolutions\Year2023\Day4;

use App\AdventSolutions\AbstractSolution;

class Solution2023Day4 extends AbstractSolution
{
    public function solvePart1($input): string
    {
        $points = 0;

        foreach ($input as $card) {
            $cardinfo = $this->parseCard($card);

            $winning_numbers = $this->countWinningNumbers($cardinfo);

            if ($winning_numbers > 0) {
                $points += pow(2, $winning_numbers) / 2;
            }
        }

        return "Total points: <info>$points</info>";
    }

    public function solvePart2($input): string
    {
        $card_count = [];

        for ($i = 0; $i < count($input); $i++) {
            $card_count[$i] = 1; // Set each value to 1
        }

        $card_num = 0;

        foreach ($input as $card) {
            $number_of_card = $card_count[$card_num];

            $cardinfo = $this->parseCard($card);

            $winning_numbers = $this->countWinningNumbers($cardinfo);

            for ($i = 0; $i < $winning_numbers; $i++) {
                $card_count[$card_num + $i + 1] += $number_of_card;
            }

            $card_num++;
        }

        print_r($card_count); // Debugging purposes, remove

        return "Number of cards: <info>" . array_sum($card_count) . "</info>";
    }

    private function parseCard($card): array
    {
        $card_number = explode(":", $card);
        $numbers = explode("|", $card_number[1]);

        $winning_numbers = explode(" ", $numbers[0]);
        $actual_numbers = explode(" ", $numbers[1]);

        return [
            "card_number" => $card_number[0],
            "winning_numbers" => array_filter($winning_numbers),
            "actual_numbers" => array_filter($actual_numbers)
        ];
    }

    private function countWinningNumbers($cardinfo): int
    {
        $result = array_intersect($cardinfo["winning_numbers"], $cardinfo["actual_numbers"]);

        return count($result);
    }
}