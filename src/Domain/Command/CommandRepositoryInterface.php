<?php

namespace App\Domain\Command;

interface CommandRepositoryInterface {
    public function insertCsvInDb(array $CSVData): bool;
}