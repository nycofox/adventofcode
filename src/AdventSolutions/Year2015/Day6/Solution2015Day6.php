<?php

namespace App\AdventSolutions\Year2015\Day6;

use App\AdventSolutions\AbstractSolution;

class Solution2015Day6 extends AbstractSolution
{
    private array $lights = [];

    public function solvePart1($input): string
    {
        foreach ($input as $instructions) {
            preg_match('/(turn on|turn off|toggle) (\d+),(\d+) through (\d+),(\d+)/', $instructions, $matches);

            $action = $matches[1];
            $x1 = $matches[2];
            $y1 = $matches[3];
            $x2 = $matches[4];
            $y2 = $matches[5];

            for ($x = $x1; $x <= $x2; $x++) {
                for ($y = $y1; $y <= $y2; $y++) {
                    switch ($action) {
                        case 'turn on':
                            $this->lights[$x . '-' . $y] = true;
                            break;
                        case 'turn off':
                            unset($this->lights[$x . '-' . $y]);
                            break;
                        case 'toggle':
                            $this->toggleLight($x, $y);
                            break;
                    }
                }
            }
        }

        $litLights = count($this->lights);

        return "There are <info>$litLights</info> lights lit.";
    }

    public function solvePart2($input): string
    {
        $this->lights = [];

        foreach ($input as $instructions) {
            preg_match('/(turn on|turn off|toggle) (\d+),(\d+) through (\d+),(\d+)/', $instructions, $matches);

            $action = $matches[1];
            $x1 = $matches[2];
            $y1 = $matches[3];
            $x2 = $matches[4];
            $y2 = $matches[5];

            for ($x = $x1; $x <= $x2; $x++) {
                for ($y = $y1; $y <= $y2; $y++) {
                    switch ($action) {
                        case 'turn on':
                            $this->increaseBrightness($x, $y);
                            break;
                        case 'turn off':
                            $this->decreaseBrightness($x, $y);
                            break;
                        case 'toggle':
                            $this->toggleBrightness($x, $y);
                            break;
                    }
                }
            }
        }

        $totalBrightness = array_sum($this->lights);

        return "The total brightness is <info>$totalBrightness</info>.";
    }

    private function toggleLight($x, $y)
    {
        if (isset($this->lights[$x . '-' . $y])) {
            unset($this->lights[$x . '-' . $y]);
        } else {
            $this->lights[$x . '-' . $y] = true;
        }
    }

    private function increaseBrightness($x, $y)
    {
        if (!isset($this->lights[$x . '-' . $y])) {
            $this->lights[$x . '-' . $y] = 0;
        }

        $this->lights[$x . '-' . $y]++;
    }

    private function decreaseBrightness($x, $y)
    {
        if (isset($this->lights[$x . '-' . $y])) {
            $this->lights[$x . '-' . $y] = max(0, $this->lights[$x . '-' . $y] - 1);
        }
    }

    private function toggleBrightness($x, $y)
    {
        if (!isset($this->lights[$x . '-' . $y])) {
            $this->lights[$x . '-' . $y] = 0;
        }

        $this->lights[$x . '-' . $y] += 2;
    }

}