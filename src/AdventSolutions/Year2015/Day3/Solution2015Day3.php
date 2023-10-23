<?php

namespace App\AdventSolutions\Year2015\Day3;

class Solution2015Day3
{

    private array $houses = [];

    public function solvePart1($input)
    {
        $directions = str_split($input[0]);

        $x = 0;
        $y = 0;

        $this->visitHouse($x, $y);

        foreach ($directions as $move) {
            switch ($move) {
                case '^':
                    $y += 1;
                    break;
                case 'v':
                    $y -= 1;
                    break;
                case '>':
                    $x += 1;
                    break;
                case '<':
                    $x -= 1;
                    break;
            }

            $this->visitHouse($x, $y);
        }

        return "Santa visited " . count($this->houses) . " houses at least once";

    }

    public function solvePart2($input)
    {
        $this->houses = [];

        $directions = str_split($input[0]);

        $realSantaX = 0;
        $realSantaY = 0;
        $roboSantaX = 0;
        $roboSantaY = 0;
        $currentSanta = 'real';

        $this->visitHouse($realSantaX, $realSantaY);

        foreach ($directions as $move) {
            // realSanta and roboSanta take turns moving
            if ($currentSanta == 'real') {
                switch ($move) {
                    case '^':
                        $realSantaY += 1;
                        break;
                    case 'v':
                        $realSantaY -= 1;
                        break;
                    case '>':
                        $realSantaX += 1;
                        break;
                    case '<':
                        $realSantaX -= 1;
                        break;
                }
                $this->visitHouse($realSantaX, $realSantaY);
                $currentSanta = 'robo';
            } else {
                switch ($move) {
                    case '^':
                        $roboSantaY += 1;
                        break;
                    case 'v':
                        $roboSantaY -= 1;
                        break;
                    case '>':
                        $roboSantaX += 1;
                        break;
                    case '<':
                        $roboSantaX -= 1;
                        break;
                }
                $this->visitHouse($roboSantaX, $roboSantaY);
                $currentSanta = 'real';
            }

        }

        return "Santa visited " . count($this->houses) . " houses at least once";

    }

    private function visitHouse($x, $y)
    {
        if (!isset($this->houses[$x . $y])) {
            $this->houses[$x . $y] = 1;
        } else {
            $this->houses[$x . $y] += 1;
        }
    }
}