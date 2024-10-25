<?php

namespace App\AdventSolutions\Year2016\Day4;

use App\AdventSolutions\AbstractSolution;

class Solution2016Day4 extends AbstractSolution
{
    public function solvePart1($input): string
    {
        $sectorIdSum = 0;

        foreach ($input as $line) {
            preg_match('/([a-z-]+)-(\d+)\[([a-z]+)]/', trim($line), $matches);
            $encryptedName = str_replace('-', '', $matches[1]);
            $sectorId = intval($matches[2]);
            $checksum = $matches[3];

            $calculatedChecksum = $this->calculateChecksum($encryptedName);

            if ($calculatedChecksum === $checksum) {
                $sectorIdSum += $sectorId;
            }
        }

        return "The sum of sector IDs of real rooms is: <info>$sectorIdSum</info>";
    }

    public function solvePart2($input): string
    {
        foreach ($input as $line) {
            preg_match('/([a-z-]+)-(\d+)\[([a-z]+)]/', trim($line), $matches);
            $encryptedName = $matches[1];
            $sectorId = intval($matches[2]);

            // Decrypt the name
            $decryptedName = $this->decryptName($encryptedName, $sectorId);

            // Check if the decrypted name contains "northpole"
            if (str_contains($decryptedName, 'northpole')) {
                return "The sector ID for the North Pole objects is: <info>$sectorId</info>";
            }
        }

        return "North Pole objects not found!";
    }

    private function calculateChecksum($name): string
    {
        $letterCounts = count_chars($name, 1);
        $sortedLetters = [];

        foreach ($letterCounts as $ascii => $count) {
            $sortedLetters[chr($ascii)] = $count;
        }

        uksort($sortedLetters, function ($a, $b) use ($sortedLetters) {
            if ($sortedLetters[$a] === $sortedLetters[$b]) {
                return strcmp($a, $b);
            }
            return $sortedLetters[$b] - $sortedLetters[$a];
        });

        return implode('', array_slice(array_keys($sortedLetters), 0, 5));
    }

    private function decryptName($name, $sectorId): string
    {
        $decryptedName = '';

        foreach (str_split($name) as $char) {
            if ($char === '-') {
                $decryptedName .= ' ';
            } else {
                $shiftedChar = chr(((ord($char) - ord('a') + $sectorId) % 26) + ord('a'));
                $decryptedName .= $shiftedChar;
            }
        }

        return $decryptedName;
    }
}
