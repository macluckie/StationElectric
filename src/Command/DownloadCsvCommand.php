<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use App\Domain\Command\Command as CommandDomain;
use App\Action\Command\CommandAction;
use App\Action\Command\CommandRepository;


#[AsCommand(
    name: 'app:download-csv',
    description: 'download csv',
)]
class DownloadCsvCommand extends Command
{

    private $params;
    private $em;
    private string $csvPath;

    public function __construct(ParameterBagInterface $params, EntityManagerInterface $em)
    {
        $this->params = $params;
        $this->em = $em;
        $this->csvPath = $this->params->get('kernel.project_dir') . '/src/csv/consolidation-etalab-schema-irve-v-2.1.0-20221102.csv';
        parent::__construct();
    }
    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
        }

        $cmdRepo = new CommandRepository($this->em);
        $cmdAction = new CommandAction();
        $cmdDomain = new CommandDomain($cmdAction, $cmdRepo);
        $arrayCSV  = $cmdDomain->csvToArray($this->csvPath);
        $error =  $cmdDomain->insertCSVInDatabase($arrayCSV);
        if ($error) {
            $io->success('Success.');
        } else {
            $io->success('ERROR INSERT.');
        }
        return Command::SUCCESS;
    }

}
