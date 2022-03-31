<?php
Namespace CsvDisplayTool\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class DisplayCsvCommand extends Command
{
    protected static $defaultName = 'csv:display-csv';

    protected function configure(): void
    {
        $this->setDescription('Allows you to Display Csv File in CLI');
        $this->addArgument('filename', InputArgument::OPTIONAL, 'Target File');
    }

    private function csvParser($filename)
    {
        $file = fopen($filename, "r");
        return fgetcsv($file, 0, ';');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $rawCsv = $this->csvParser($input->getArgument('filename'));
        var_dump($rawCsv);

        $table = new Table($output);
        $table
            ->setHeaders($rawCsv);
        ;
        $table->render();
        return 0;
    }
}