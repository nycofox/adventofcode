<?php

namespace App\AdventSolutions;
abstract class AbstractSolution
{
    abstract public function solvePart1(array $input): string;

    abstract public function solvePart2(array $input): string;
}