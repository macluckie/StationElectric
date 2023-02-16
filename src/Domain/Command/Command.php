<?php

namespace App\Domain\Command;

use Exception;

class Command
{
    private $cmdInterface;
    private $repo;

    public function __construct(CommandInterface $cmdInterface, CommandRepositoryInterface $repo)
    {
        $this->cmdInterface = $cmdInterface;
        $this->repo = $repo;
    }

    public function csvToArray(string $csvPath): array
    {
        if (!is_file($csvPath)) {
            throw new Exception('Error csv file not found');
        }
        $dataArrayCSV = $this->cmdInterface->csvToArray($csvPath);
        return $dataArrayCSV;
    }

    public function insertCSVInDatabase(array $dataArrayCSV): void
    {
        if (count($dataArrayCSV) > 0) {
            try {
                $this->repo->insertCsvInDb($dataArrayCSV);
            } catch (\Throwable $th) {
                throw new Exception('Error insertion csv in database: ' . $th->getMessage());
            }
        }
    }
}
