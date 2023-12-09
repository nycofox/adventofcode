<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'advent-create',
    description: 'Add a short description for your command',
)]
class AdventCreateCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Create a blank template for an Advent of Code challenge.')
            ->addArgument('year', InputArgument::REQUIRED, 'The year of the challenge (e.g., 2022).')
            ->addArgument('day', InputArgument::REQUIRED, 'The day of the challenge (e.g., 1).');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $year = $input->getArgument('year');
        $day = $input->getArgument('day');

        // Construct the directory path
        $challengeDirectory = sprintf('src/AdventSolutions/Year%d/Day%d', $year, $day);

        // Check if the directory already exists
        if (is_dir($challengeDirectory)) {
            $output->writeln("The directory for Year $year, Day $day already exists.");
            return Command::FAILURE;
        }

        // Create the directory
        if (!mkdir($challengeDirectory, 0755, true)) {
            $output->writeln("Failed to create the directory for Year $year, Day $day.");
            return Command::FAILURE;
        }

        // Create README.md
        $readmeContent = <<<EOF
# Advent of Code $year - Day $day

## Problem Statement

## Input

## Part 1

## Part 2
EOF;

        file_put_contents($challengeDirectory . '/README.md', $readmeContent);

        // Create input.txt
        touch($challengeDirectory . '/input.txt');

        // Create input_text.txt
        touch($challengeDirectory . '/input_test.txt');

        // Create Solution file
        $solutionContent = <<<EOF
<?php

namespace App\AdventSolutions\Year$year\Day$day;

use App\AdventSolutions\AbstractSolution;

class Solution{$year}Day{$day} extends AbstractSolution
{
    public function solvePart1(\$input): string
    {
        // Implement the logic for solving part 1 here
        
        return "Part 1 not yet implemented!";
    }

    public function solvePart2(\$input): string
    {
        // Implement the logic for solving part 2 here
        
        return "Part 2 not yet implemented!";
    }
}
EOF;

        file_put_contents($challengeDirectory . '/Solution' . $year . 'Day' . $day . '.php', $solutionContent);

        $output->writeln("Blank template created for Year $year, Day $day.");
        return Command::SUCCESS;
    }
}