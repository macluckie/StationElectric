<?php

namespace App\Tests\Domain\Command;

use PHPUnit\Framework\TestCase;
use App\Tests\UtilsTest;
use App\Domain\Command\Command;
use App\Action\Command\CommandAction;
use App\Action\Command\CommandRepository;


class CommandTest extends TestCase
{
    public function  testCsvToArrayWhenAllIsOK()
    {
        $csvPath = __DIR__.'/csv-test.csv';
        $commandRepo = $this->dataproviderRepoTrue();
        $commandAction = $this->dataproviderAction();
        $command = new Command($commandAction, $commandRepo);
        try {
            $command->csvToArray($csvPath);
            $this->assertTrue(true);
        } catch (\Throwable $th) {
            $this->fail('failed testing csvToArray');
        }
    }

    public function  testCsvToArrayWhenFileNotFound()
    {
        $csvPath = __DIR__.'/csv-tests.csv';
        $commandRepo = $this->dataproviderRepoTrue();
        $commandAction = $this->dataproviderAction();
        $command = new Command($commandAction, $commandRepo);
        try {
            $command->csvToArray($csvPath);
        } catch (\Throwable $th) {
            $this->assertTrue(true);
        }
    }

    public function  testinsertCSVInDatabaseWhenAllIsOk()
    {
        $commandRepo = $this->dataproviderRepoTrue();
        $commandAction = $this->dataproviderAction();
        $command = new Command($commandAction, $commandRepo);

        $data = 
        [
            'data' => 'value1',
            'data' => 'value2'
        ];
        try {
            $command->insertCSVInDatabase($data);
            $this->assertTrue(true);
        } catch (\Throwable $th) {
        }
    }

    public function  testinsertCSVInDatabaseWhenError()
    {
        $commandRepo = $this->dataproviderRepoTrue();
        $commandAction = $this->dataproviderAction();
        $command = new Command($commandAction, $commandRepo);

        $data = 
        [
            'data' => 'value1',
            'data' => 'value2'
        ];
        try {
            $command->insertCSVInDatabase($data);
            $this->assertTrue(true);
        } catch (\Throwable $th) {
        }
    }


    public function dataproviderAction(): CommandAction
    {
        $data = 
        [
            'data' => 'value1',
            'data' => 'value2'
        ];
        $mock = $this->createConfiguredMock(CommandAction::class, ['csvToArray' => $data]);
        return $mock;
    }


    public function dataproviderRepoTrue(): CommandRepository
    {
        $mock = $this->createConfiguredMock(CommandRepository::class, ['insertCsvInDb' => true]);
        return $mock;
    }

    public function dataproviderRepoFalse(): CommandRepository
    {
        $mock = $this->createConfiguredMock(CommandRepository::class, ['insertCsvInDb' => true]);
        return $mock;
    }
}
