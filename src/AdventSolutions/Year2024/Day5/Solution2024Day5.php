<?php

namespace App\AdventSolutions\Year2024\Day5;

use App\AdventSolutions\AbstractSolution;

class Solution2024Day5 extends AbstractSolution
{
    private const RULE_DELIMITER = '|';
    private const PAGE_DELIMITER = ',';

    public function solvePart1($input, $debug = false): string
    {
        [$rules, $updates] = $this->parseInput($input);
        $total = 0;

        foreach ($updates as $update) {
            if ($this->isUpdateValid($update, $rules)) {
                $total += $this->getMiddlePage($update);
            }
        }

        return "The total sum of middle pages is: <info>$total</info>";
    }

    public function solvePart2($input, $debug = false): string
    {
        [$rules, $updates] = $this->parseInput($input);
        $total = 0;

        foreach ($updates as $update) {
            if (!$this->isUpdateValid($update, $rules)) {
                $sortedUpdate = $this->sortUpdate($update, $rules);
                $total += $this->getMiddlePage($sortedUpdate);
            }
        }

        return "The total sum of middle pages after reordering is: <info>$total</info>";
    }

    private function parseInput(array $input): array
    {
        $splitIndex = array_search('', $input);
        $rules = $this->parseRules(array_slice($input, 0, $splitIndex));
        $updates = $this->parseUpdates(array_slice($input, $splitIndex + 1));
        return [$rules, $updates];
    }

    private function parseRules(array $rulesInput): array
    {
        $rules = [];
        foreach ($rulesInput as $rule) {
            [$x, $y] = explode(self::RULE_DELIMITER, $rule);
            $rules[] = [(int)$x, (int)$y];
        }
        return $rules;
    }

    private function parseUpdates(array $updatesInput): array
    {
        return array_map(function ($update) {
            return array_map('intval', explode(self::PAGE_DELIMITER, $update));
        }, $updatesInput);
    }

    private function isUpdateValid(array $update, array $rules): bool
    {
        $positions = array_flip($update);
        foreach ($rules as [$x, $y]) {
            if (isset($positions[$x]) && isset($positions[$y])) {
                if ($positions[$x] >= $positions[$y]) {
                    return false;
                }
            }
        }
        return true;
    }

    private function sortUpdate(array $update, array $rules): array
    {
        // Build a directed graph from the rules
        $graph = [];
        $inDegree = [];

        foreach ($update as $page) {
            $graph[$page] = [];
            $inDegree[$page] = 0;
        }

        foreach ($rules as [$x, $y]) {
            if (in_array($x, $update) && in_array($y, $update)) {
                $graph[$x][] = $y;
                $inDegree[$y]++;
            }
        }

        // Perform topological sort
        $queue = [];
        foreach ($inDegree as $page => $count) {
            if ($count === 0) {
                $queue[] = $page;
            }
        }

        $sorted = [];
        while ($queue) {
            $current = array_shift($queue);
            $sorted[] = $current;

            foreach ($graph[$current] as $neighbor) {
                $inDegree[$neighbor]--;
                if ($inDegree[$neighbor] === 0) {
                    $queue[] = $neighbor;
                }
            }
        }

        return $sorted;
    }

    private function getMiddlePage(array $update): int
    {
        $middleIndex = intdiv(count($update), 2);
        return $update[$middleIndex];
    }
}
