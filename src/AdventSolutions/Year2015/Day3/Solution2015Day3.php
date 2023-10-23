<?php

namespace App\AdventSolutions\Year2015\Day3;

use App\AdventSolutions\AbstractSolution;

class Solution2015Day3 extends AbstractSolution
{
    private array $houses = [];

    public function solvePart1($input): string
    {
        $directions = str_split($input[0]);
        $x = 0;
        $y = 0;
        $this->visitHouse($x, $y);

        foreach ($directions as $move) {
            [$dx, $dy] = $this->getDirection($move);
            $x += $dx;
            $y += $dy;
            $this->visitHouse($x, $y);
        }

        return "Santa visited " . count($this->houses) . " houses at least once";
    }

    public function solvePart2($input): string
    {
        $this->houses = [];
        $directions = str_split($input[0]);
        $santaX = 0;
        $santaY = 0;
        $roboSantaX = 0;
        $roboSantaY = 0;
        $this->visitHouse($santaX, $santaY);

        for ($i = 0; $i < count($directions); $i++) {
            [$dx, $dy] = $this->getDirection($directions[$i]);

            if ($i % 2 === 0) {
                $santaX += $dx;
                $santaY += $dy;
                $this->visitHouse($santaX, $santaY);
            } else {
                $roboSantaX += $dx;
                $roboSantaY += $dy;
                $this->visitHouse($roboSantaX, $roboSantaY);
            }
        }

        return "Santa visited " . count($this->houses) . " houses at least once";
    }

    private function visitHouse($x, $y)
    {
        $this->houses[$x . $y] = true;
    }

    private function getDirection($move)
    {
        switch ($move) {
            case '^':
                return [0, 1];
            case 'v':
                return [0, -1];
            case '>':
                return [1, 0];
            case '<':
                return [-1, 0];
            default:
                return [0, 0];
        }
    }
}