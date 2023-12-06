# Advent of Code Solutions

This repository contains my solutions for the Advent of Code programming challenges. Each year and day have their own
solution files and input data.

## Getting Started

To get started with this project, follow these steps:

1. Clone this repository to your local machine:

   ```shell
   git clone https://github.com/nycofox/adventofcode.git
    ```

2. Install the project dependencies:

   ```shell
   composer install
   ```

3. Run the advent command to execute the solutions for the Advent of Code challenges. You must provide the year and day
   as arguments.

   ```shell
   ./advent 2023 1
   ```

4. To set up template files for a new daily solution, execute the command below. You need to specify both the year and
   the day as arguments. Executing this command accomplishes two things:

   1. It creates a new directory uniquely for the specified year and day.
   2. It generates template files for both the solution and input files within this new directory.

   ```shell
   ./advent-create 2023 1
   ```
