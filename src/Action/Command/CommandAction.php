<?php

namespace App\Action\Command;

use App\Domain\Command\CommandInterface;


class CommandAction implements CommandInterface
{

    /**
     * Undocumented function
     *
     * @param string $CSVPath
     * @return array<string>
     */
    public function csvToArray(string $CSVPath): array
    {
        $array = [];
        if (($open = fopen($CSVPath, "r")) !== false) {
            while (($data = fgetcsv($open, 1000, ",")) !== false) {
                $array[] = $data;
            }
        }
        fclose($open);
        return $array;
    }
}
