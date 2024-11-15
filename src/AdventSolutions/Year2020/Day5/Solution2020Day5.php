<?php

namespace App\AdventSolutions\Year2020\Day5;

use App\AdventSolutions\AbstractSolution;

class Solution2020Day5 extends AbstractSolution
{
    public function solvePart1($input): string
    {
        $maxSeatId = 0;

        foreach ($input as $boardingPass) {
            $row = $this->findRow(substr($boardingPass, 0, 7));
            $column = $this->findColumn(substr($boardingPass, 7, 3));
            $seatId = $row * 8 + $column;
            if ($seatId > $maxSeatId) {
                $maxSeatId = $seatId;
            }
        }

        return "The highest seat ID on a boarding pass is: <info>$maxSeatId</info>";
    }

    public function solvePart2($input): string
    {
        $seatIds = [];

        foreach ($input as $boardingPass) {
            $row = $this->findRow(substr($boardingPass, 0, 7));
            $column = $this->findColumn(substr($boardingPass, 7, 3));
            $seatId = $row * 8 + $column;
            $seatIds[] = $seatId;
        }

        sort($seatIds);
        $mySeatId = 0;

        for ($i = 0; $i < count($seatIds) - 1; $i++) {
            if ($seatIds[$i + 1] - $seatIds[$i] === 2) {
                $mySeatId = $seatIds[$i] + 1;
                break;
            }
        }

        return "My seat ID is: <info>$mySeatId</info>";
    }

    private function findRow($string): int
    {
        $min = 0;
        $max = 127;
        for ($i = 0; $i < 7; $i++) {
            $mid = ($min + $max) / 2;
            if ($string[$i] === 'F') {
                $max = floor($mid);
            } else {
                $min = ceil($mid);
            }
        }
        return $min;
    }

    private function findColumn($string): int
    {
        $min = 0;
        $max = 7;
        for ($i = 0; $i < 3; $i++) {
            $mid = ($min + $max) / 2;
            if ($string[$i] === 'L') {
                $max = floor($mid);
            } else {
                $min = ceil($mid);
            }
        }
        return $min;
    }
}