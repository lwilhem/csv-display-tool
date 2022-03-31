<?php
Namespace CsvDisplayTool\Command;

use CsvDisplayTool\CsvFormatter\csvFormatter;
use CsvDisplayTool\CsvParser\CsvParser;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

ini_set('auto_detect_line_endings',TRUE);

class DisplayCsvCommand extends Command
{
    protected static $defaultName = 'csv:display-csv';

    protected function configure(): void
    {
        $this->setDescription('Allows you to Display Csv File in CLI');
        $this->addArgument('filename', InputArgument::OPTIONAL, 'Target File');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $parseImport = new CsvParser();
        $formatterImport = new csvFormatter();

        $parsedArray = $parseImport->csvParser($input->getArgument('filename'));
        $formattedArray = $formatterImport->formatArray($parsedArray);

        var_dump($formattedArray);

        $table = new Table($output);
        $table
            ->setHeaders([]);
        ;
        $table->render();
        return 0;
    }
}