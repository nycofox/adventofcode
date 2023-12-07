<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Process;

#[AsCommand(
    name: 'advent',
    description: 'Solve Advent of Code puzzles in PHP.',
)]
class AdventCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Solve Advent of Code puzzles in PHP.')
            ->setHelp('This command solves Advent of Code puzzles.')
            ->addArgument('year', InputArgument::REQUIRED, 'The year for the Advent of Code puzzle.')
            ->addArgument('day', InputArgument::REQUIRED, 'The day for the Advent of Code puzzle.')
            ->addOption('test', 't', InputOption::VALUE_NONE, 'Run the test input for the solution.')
        ->addOption('debug', 'd', InputOption::VALUE_NONE, 'Run the solution with debug output enabled.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $year = $input->getArgument('year');
        $day = $input->getArgument('day');

        // Construct the class name for the solution file based on the provided year and day
        $solutionClassName = 'App\\AdventSolutions\\Year' . $year . '\\Day' . $day . '\\Solution' . $year . 'Day' . $day;

        // Check if the solution class exists
        if (!class_exists($solutionClassName)) {
            $output->writeln("No solution found for year $year, day $day.");
            $output->writeln("Using class name: $solutionClassName");
            return Command::FAILURE;
        }

        // Instantiate the solution class
        $solution = new $solutionClassName();

        // Read the input data from a file (input.txt)
        $inputfilename = $input->getOption('test') ? 'input_test.txt' : 'input.txt';
        $inputFilePath = __DIR__ . '/../AdventSolutions/Year' . $year . '/Day' . $day . '/' . $inputfilename;
        $input = file($inputFilePath, FILE_IGNORE_NEW_LINES);

        // Call the solvePart1 and solvePart2 methods
        $resultPart1 = $solution->solvePart1($input);
        $resultPart2 = $solution->solvePart2($input);

        // Display the results
        $output->writeln(["", "<comment>Advent of Code Results for day $day in $year:</comment>"]);
        if($inputfilename == 'input_test.txt') {
            $output->writeln("<error>Test input used.</error>");
        }
        $output->writeln("<info>Part 1:</info> $resultPart1");
        $output->writeln("<info>Part 2:</info> $resultPart2");

        return Command::SUCCESS;
    }
}