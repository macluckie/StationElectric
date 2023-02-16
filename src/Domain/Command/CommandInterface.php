<?php

namespace App\Domain\Command;

interface CommandInterface {
    public function csvToArray(string $CSVPath);
}