<?php

namespace App\AdventSolutions\Year2018\Day3;

use App\AdventSolutions\AbstractSolution;

class Solution2018Day3 extends AbstractSolution
{
    private $grid = [];

    public function solvePart1($input): string
    {
        foreach ($input as $line) {
            $claim = $this->getClaim($line);

            for ($x = $claim['x']; $x < $claim['x'] + $claim['width']; $x++) {
                for ($y = $claim['y']; $y < $claim['y'] + $claim['height']; $y++) {
                    if (!isset($this->grid[$x . '-' . $y])) {
                        $this->grid[$x . '-' . $y] = 1;
                    } else {
                        $this->grid[$x . '-' . $y]++;
                    }
                }
            }
        }

        $overlap = count(array_filter($this->grid, function ($value) {
            return $value > 1;
        }));

        return "The number of square inches of fabric are within two or more claims is: <info>$overlap</info>";
    }

    public function solvePart2($input): string
    {
        $claims = [];

        foreach ($input as $line) {
            $claim = $this->getClaim($line);
            $claims[$claim['id']] = $claim;
        }

        foreach ($claims as $claim) {
            $overlap = false;

            for ($x = $claim['x']; $x < $claim['x'] + $claim['width']; $x++) {
                for ($y = $claim['y']; $y < $claim['y'] + $claim['height']; $y++) {
                    if ($this->grid[$x . '-' . $y] > 1) {
                        $overlap = true;
                    }
                }
            }

            if (!$overlap) {
                return "The ID of the only claim that doesn't overlap is: <info>{$claim['id']}</info>";
            }
        }

        return 'No claim found that doesn\'t overlap';
    }

    private function getClaim($claim)
    {
        $claim = explode(' ', $claim);
        $claimId = substr($claim[0], 1);
        $claimCoords = explode(',', $claim[2]);
        $claimSize = explode('x', $claim[3]);

        return [
            'id' => $claimId,
            'x' => (int)$claimCoords[0],
            'y' => (int)$claimCoords[1],
            'width' => (int)$claimSize[0],
            'height' => (int)$claimSize[1],
        ];
    }
}