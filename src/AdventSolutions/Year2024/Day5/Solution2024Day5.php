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

        $validMiddlePagesSum = array_sum(
            array_map(
                fn($update) => $this->isValidUpdate($update, $rules) ? $this->getMiddlePage($update) : 0,
                $updates
            )
        );

        return "The total sum of middle pages is: <info>$validMiddlePagesSum</info>";
    }

    public function solvePart2($input, $debug = false): string
    {
        [$rules, $updates] = $this->parseInput($input);

        $invalidMiddlePagesSum = array_sum(
            array_map(
                fn($update) => !$this->isValidUpdate($update, $rules)
                    ? $this->getMiddlePage($this->sortUpdate($update, $rules))
                    : 0,
                $updates
            )
        );

        return "The total sum of middle pages after reordering is: <info>$invalidMiddlePagesSum</info>";
    }

    private function parseInput(array $input): array
    {
        $splitIndex = array_search('', $input);
        return [
            $this->parseRules(array_slice($input, 0, $splitIndex)),
            $this->parseUpdates(array_slice($input, $splitIndex + 1)),
        ];
    }

    private function parseRules(array $rulesInput): array
    {
        return array_map(
            fn($rule) => array_map('intval', explode(self::RULE_DELIMITER, $rule)),
            $rulesInput
        );
    }

    private function parseUpdates(array $updatesInput): array
    {
        return array_map(
            fn($update) => array_map('intval', explode(self::PAGE_DELIMITER, $update)),
            $updatesInput
        );
    }

    private function isValidUpdate(array $update, array $rules): bool
    {
        $pagePositions = array_flip($update);

        foreach ($rules as [$before, $after]) {
            if (isset($pagePositions[$before], $pagePositions[$after]) &&
                $pagePositions[$before] >= $pagePositions[$after]) {
                return false;
            }
        }

        return true;
    }

    private function sortUpdate(array $update, array $rules): array
    {
        $graph = $this->buildGraph($update, $rules);
        return $this->topologicalSort($graph);
    }

    private function buildGraph(array $update, array $rules): array
    {
        $graph = array_fill_keys($update, []);
        $inDegree = array_fill_keys($update, 0);

        foreach ($rules as [$before, $after]) {
            if (in_array($before, $update) && in_array($after, $update)) {
                $graph[$before][] = $after;
                $inDegree[$after]++;
            }
        }

        return compact('graph', 'inDegree');
    }

    private function topologicalSort(array $graphData): array
    {
        ['graph' => $graph, 'inDegree' => $inDegree] = $graphData;

        $queue = array_keys(array_filter($inDegree, fn($degree) => $degree === 0));
        $sorted = [];

        while (!empty($queue)) {
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
        return $update[intdiv(count($update), 2)];
    }
}
