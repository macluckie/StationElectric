<?php

namespace App\Action\Command;

use App\Domain\Command\CommandInterface;


class CommandAction implements CommandInterface
{

    public function csvToArray(string $CSVPath)
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
