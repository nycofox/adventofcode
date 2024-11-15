<?php

namespace App\AdventSolutions\Year2020\Day4;

use App\AdventSolutions\AbstractSolution;

class Solution2020Day4 extends AbstractSolution
{
    public function solvePart1($input): string
    {
        $passports = $this->findPassports($input);
        $validPassports = 0;
        foreach ($passports as $passport) {
            if ($this->validatePassport($passport)) {
                $validPassports++;
            }
        }
        return "Valid passports: <info>$validPassports</info>";
    }

    public function solvePart2($input): string
    {
        $passports = $this->findPassports($input);
        $validPassports = 0;
        foreach ($passports as $passport) {
            if ($this->validatePassport($passport) && $this->validateFields($passport)) {
                $validPassports++;
            }
        }
        return "Valid passports: <info>$validPassports</info>";
    }

    private function findPassports($input): array
    {
        $passports = [];
        $passport = [];
        foreach ($input as $line) {
            if (empty($line)) {
                $passports[] = $passport;
                $passport = [];
            } else {
                $passport = array_merge($passport, $this->parseLine($line));
            }
        }
        $passports[] = $passport;
        return $passports;
    }

    private function validatePassport($passport): bool
    {
        if (count($passport) === 8 || (count($passport) === 7 && !isset($passport['cid']))) {
            return true;
        }
        return false;
    }

    private function validateFields($passport): bool
    {
        foreach ($passport as $key => $value) {
            switch ($key) {
                case 'byr':
                    if ($value < 1920 || $value > 2002) {
                        return false;
                    }
                    break;
                case 'iyr':
                    if ($value < 2010 || $value > 2020) {
                        return false;
                    }
                    break;
                case 'eyr':
                    if ($value < 2020 || $value > 2030) {
                        return false;
                    }
                    break;
                case 'hgt':
                    if (preg_match('/^(\d+)(cm|in)$/', $value, $matches)) {
                        if ($matches[2] === 'cm' && ($matches[1] < 150 || $matches[1] > 193)) {
                            return false;
                        }
                        if ($matches[2] === 'in' && ($matches[1] < 59 || $matches[1] > 76)) {
                            return false;
                        }
                    } else {
                        return false;
                    }
                    break;
                case 'hcl':
                    if (!preg_match('/^#[0-9a-f]{6}$/', $value)) {
                        return false;
                    }
                    break;
                case 'ecl':
                    if (!in_array($value, ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'])) {
                        return false;
                    }
                    break;
                case 'pid':
                    if (!preg_match('/^\d{9}$/', $value)) {
                        return false;
                    }
                    break;
            }
        }
        return true;
    }

    private function parseLine($line): array
    {
        $fields = explode(' ', $line);
        $passport = [];
        foreach ($fields as $field) {
            [$key, $value] = explode(':', $field);
            $passport[$key] = $value;
        }
        return $passport;
    }
}